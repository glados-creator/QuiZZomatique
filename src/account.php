<?php

$sqlInstance = \DB\sql::getInstance();

$errorMessage = '';

if (isset($_SESSION['user'])) {
    // Display user account details if logged in
    $user = $_SESSION['user'];
    ?>
    <h1>Mon Compte</h1>
    <ul>
        <li>ID: <?php echo htmlspecialchars($user->getId()); ?></li>
        <li>Email: <?php echo htmlspecialchars($user->getEmail()); ?></li>
        <li>Nom: <?php echo htmlspecialchars($user->getNom()); ?></li>
        <li>Prénom: <?php echo htmlspecialchars($user->getPrenom()); ?></li>
    </ul>
    <form action="index.php?action=account" method="post">
        <input type="hidden" name="logout" value="1">
        <button type="submit">Se déconnecter</button>
    </form>
    <?php
    // Handle logout
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
        session_destroy();
        header("Location: index.php?action=account");
        exit;
    }
} else {
    // Handle login and registration
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $nom = trim($_POST['nom'] ?? '');
        $prenom = trim($_POST['prenom'] ?? '');

        try {
            if (isset($_POST['register'])) {
                // Registration logic
                if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
                    throw new Exception("Tous les champs sont obligatoires pour l'inscription.");
                }
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new Exception("Email invalide.");
                }
                $sqlInstance->addUser($nom, $prenom, $password, $email);
                $_SESSION['user'] = new User(uniqid(), $email, $nom, $prenom, sha1($password), false);
                header("Location: index.php?action=account");
                exit;
            } else {
                // Login logic
                if (empty($email) || empty($password)) {
                    throw new Exception("Email et mot de passe requis pour la connexion.");
                }
                $user = $sqlInstance->authenticateUser($email, $password);
                if (!$user) {
                    throw new Exception("Identifiants incorrects.");
                }
                $_SESSION['user'] = $user;
                header("Location: index.php?action=account");
                exit;
            }
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
        }
    }
    ?>

    <div class="flex" style="justify-content: space-around;">
        <div style="border: 1px solid; border-radius: 20%; padding: 20px;">
            <h1>Créer un compte</h1>
            <?php if ($errorMessage && isset($_POST['register'])): ?>
                <p style="color:red;"><?php echo htmlspecialchars($errorMessage); ?></p>
            <?php endif; ?>
            <form action="index.php?action=account" method="post">
                <label for="nom">Nom:</label>
                <input type="text" name="nom" placeholder="Entrez votre nom" required>

                <label for="prenom">Prénom:</label>
                <input type="text" name="prenom" placeholder="Entrez votre prénom" required>

                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Entrez votre email" required>

                <label for="password">Mot de passe:</label>
                <input type="password" name="password" placeholder="Entrez un mot de passe" required>

                <input type="hidden" name="register" value="1">
                <button type="submit">Créer un compte</button>
            </form>
        </div>

        <div style="border: 1px solid; border-radius: 20%; padding: 20px;">
            <h1>Connexion</h1>
            <?php if ($errorMessage && !isset($_POST['register'])): ?>
                <p style="color:red;"><?php echo htmlspecialchars($errorMessage); ?></p>
            <?php endif; ?>
            <form action="index.php?action=account" method="post">
                <label for="email">Email:</label>
                <input type="email" name="email" placeholder="Entrez votre email" required>

                <label for="password">Mot de passe:</label>
                <input type="password" name="password" placeholder="Entrez votre mot de passe" required>

                <button type="submit">Se connecter</button>
            </form>
        </div>
    </div>
    <?php
}
?>
