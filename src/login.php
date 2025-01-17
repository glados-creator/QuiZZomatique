<div class="flex" style="justify-content: space-around;">
    <div style="border: 1px solid; border-radius: 20%; padding: 20px;">
        <h1>Se créer un compte</h1>
        <form action="./index?action=account_create" method="post">
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
        <form action="../compte/connection_next.php" method="post">
            <label for="email">Email:</label>
            <input type="email" name="email" value="" placeholder="Entrez votre email" required>
            <label for="password">Mot de passe:</label>
            <input type="password" name="password" value="" placeholder="Entrez votre mot de passe" required>
            <input type="submit" value="Se connecter">
        </form>
    </div>

</div>