<?php

declare(strict_types=1);

namespace DB;

class loader_sql {
    private $pdo;

    public function __construct($host, $dbname, $username, $password) {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "<p>ERREUR de base de donner</p>";
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Insert User
    public function insertUser($nom, $prenom, $password) {
        $hashedPassword = sha1($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO user (nom, prenom, password) VALUES (?, ?, ?)");
        $stmt->execute([$nom, $prenom, $hashedPassword]);
    }

    // Insert Quizz
    public function insertQuizz() {
        $stmt = $this->pdo->prepare("INSERT INTO quizz () VALUES ()");
        $stmt->execute();
    }

    // Insert Resultat
    public function insertResultat($userId, $quizzId, $note) {
        $stmt = $this->pdo->prepare("INSERT INTO resultat (user_id, quizz_id, note) VALUES (?, ?, ?)");
        $stmt->execute([$userId, $quizzId, $note]);
    }

    // Retrieve Results
    public function getResults() {
        $stmt = $this->pdo->prepare(
            "SELECT user.nom, user.prenom, quizz.id AS quizz_id, resultat.note 
            FROM resultat 
            JOIN user ON resultat.user_id = user.id 
            JOIN quizz ON resultat.quizz_id = quizz.id"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

// Create Tables
function createTables() {
    $host = getenv("DBHOST") || "";
    $dbname = getenv("DBNAME") || "";
    $username = getenv("DBUSER") || "";
    $password = getenv("DBPASS") || "";
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "<p>ERREUR de base de donner</p>";
        die("Database connection failed: " . $e->getMessage());
    }
    $userTable = "CREATE TABLE IF NOT EXISTS user (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nom VARCHAR(20) NOT NULL,
        prenom VARCHAR(20) NOT NULL,
        password VARCHAR(20) NOT NULL
    )";

    $quizzTable = "CREATE TABLE IF NOT EXISTS quizz (
        id VARCHAR(20) PRIMARY KEY
    )";

    $resultatTable = "CREATE TABLE IF NOT EXISTS resultat (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        quizz_id VARCHAR(20) NOT NULL,
        note INT NOT NULL,
        FOREIGN KEY (user_id) REFERENCES user(id),
        FOREIGN KEY (quizz_id) REFERENCES quizz(id)
    )";

    $pdo->exec($userTable);
    $pdo->exec($quizzTable);
    $pdo->exec($resultatTable);
}

if (__FILE__ == realpath($_SERVER['SCRIPT_FILENAME'])) {
    // Code to run only when this file is executed directly
    echo "creating the database";
    createTables();
}