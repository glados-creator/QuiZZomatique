<header>
    <nav>
        <ul>
            <li><a href="index.php?action=index"><img src="static/logo.png" alt="logo.png"></a></li>
            <li><p>QuizzOmatique</p></li>
            <ul style="flex-wrap : wrap;">
                <li><a href="index.php?action=quizz">Quizz</a></li>
                <?php if (\Commun\commun::is_login() && $_SESSION['user']->getProf()) {
                ?>
                <li><a href="index.php?action=admin">Créer un quizz</a></li>
                <?php } ?>
                <li><a href="index.php?action=account">Compte</a></li>
        </ul>
    </nav>
</header>
<h2><?php var_dump($_SESSION)?></h2>