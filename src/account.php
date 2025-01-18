<?php
if ($_SESSION['user'] != null) {
    loged:
    \Commun\commun::must_login();
    ?>
<ul>
    <li><?php echo $_SESSION["user"]->id; ?> </li>
    <li><?php echo $_SESSION["user"]->email; ?> </li>
    <li><?php echo $_SESSION["user"]->nom; ?> </li>
    <li><?php echo $_SESSION["user"]->prenom; ?> </li>
    <li><?php echo $_SESSION["user"]->password; ?> </li>
</ul>
<?php
} else {
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    try {
        $nom = $_POST['nom'] ?? null;
        $prenom = $_POST['prenom'] ?? null;
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;



        if (!$nom || !$prenom && $email != null && $password != null ){

            $userHandler = $sqlInstance->authenticateUser($email,$password);
            if ($userHandler == null) {
                throw new Exception("Veuillez selectionnez un utilisaateur qui existe.");
            }
            else{
                $_SESSION["user"]=$userHandler;
                goto loged;
            }
        }



        else if($nom != null && $prenom != null && $email != null && $password != null ){
            $hashedPassword = sha1($password);
            $userHandler = new user($sqlInstance);
            $userHandler->addUser($nom, $prenom, $email, $hashedPassword);
            $_SESSION['user'] = $userHandler;
            goto loged;
        }

        else if (!$nom || !$prenom || !$email || !$password) {
            throw new Exception("Veuillez remplir tous les champs.");
        }


    } catch (Exception $e) {
        // Display error and terminate
        die("Erreur : " . htmlspecialchars($e->getMessage()));
    }
} else {
    ?>
    <div class="flex" style="justify-content: space-around;">
        <div style="border: 1px solid; border-radius: 20%; padding: 20px;">
            <h1>Se créer un compte</h1>
            <form action="index.php?action=account" method="post">
                <label for="nom">Nom:</label>
                <input type="text" name="nom" value="" placeholder="Entrez votre nom" required>
                <label for="prenom">Prénom:</label>
                <input type="text" name="prenom" value="" placeholder="Entrez votre prénom" required>
                <label for="email">Email:</label>
                <input type="email" name="email" value="" placeholder="Entrez votre email" required>
                <label for="password">Mot de passe:</label>
                <input type="password" name="password" value="" placeholder="Entrez un mot de passe" required>
                <input type="submit" value="Créer un compte">
            </form>
        </div>

        <!-- Login Form -->
        <div style="border: 1px solid; border-radius: 20%; padding: 20px;">
            <h1>J'ai un compte</h1>
            <form action="index.php?action=account" method="post">
                <label for="email">Email:</label>
                <input type="email" name="email" value="" placeholder="Entrez votre email" required>
                <label for="password">Mot de passe:</label>
                <input type="password" name="password" value="" placeholder="Entrez votre mot de passe" required>
                <input type="submit" value="Se connecter">
            </form>
        </div>

    </div>
    <?php
}
}

?>