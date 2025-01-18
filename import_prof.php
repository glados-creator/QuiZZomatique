<?php

include_once 'Classes/autoloader.php';

Autoloader::register();

class UserLoader {
    public static function addUser(string $id, string $email, string $nom, string $prenom, string $password, bool $prof): void {
        $user = new DB\user($id, $email, $nom, $prenom, $password, $prof);
        self::saveToDatabase($user);
    }

    private static function saveToDatabase(DB\user $user): void {
        $pdo = \DB\sql::getInstance()->pdo;

        try {
            $stmt = $pdo->prepare("INSERT INTO users (id, email, nom, prenom, password, prof) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([
                $user->getId(),
                $user->getEmail(),
                $user->getNom(),
                $user->getPrenom(),
                $user->getPassword(),
                $user->getProf()
            ]);

            echo "User '{$user->getEmail()}' successfully added to the database.\n";
        } catch (\PDOException $e) {
            echo "Error adding user to the database: " . $e->getMessage();
        }
    }
}

// Check if the script is run directly from the command line
if (php_sapi_name() === 'cli') {
    $options = getopt("", ["id:", "email:", "nom:", "prenom:", "password:"]);

    $id = $options['id'] ?? '';
    $email = $options['email'] ?? '';
    $nom = $options['nom'] ?? '';
    $prenom = $options['prenom'] ?? '';
    $password = $options['password'] ?? '';

    if (empty($id) || empty($email) || empty($nom) || empty($prenom) || empty($password)) {
        echo "Usage: php add_user.php --id=ID --email=EMAIL --nom=NOM --prenom=PRENOM --password=PASSWORD\n";
        exit(1);
    }
    UserLoader::addUser($id, $email, $nom, $prenom, sha1( $password), true);
}
?>
