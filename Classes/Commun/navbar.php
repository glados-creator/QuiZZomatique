<header>
    <nav>
        <ul>
            <li><a href="index.php?action=index"><img src="static/logo.png" alt="logo.png"></a></li>
            <li><p>QuizzOmatique</p></li>
            <ul style="flex-wrap : wrap;">
                <li><a href="index.php?action=quizz">Quizz</a></li>
                <?php if ($_SESSION['user'] != null): ?>
                    <?php if (\Commun\commun::is_login() && $_SESSION['user']->getProf()):?>
                        <li><a href="index.php?action=create">Créer un quizz</a></li>
                    <?php endif; ?>

                    <?php if (\Commun\commun::is_login()):?>
                    
                    <?php endif; ?>

                <?php endif; ?>

                <li><a href="index.php?action=account">Compte</a></li>
        </ul>
    </nav>
</header>
<h2><?php var_dump($_SESSION)?></h2>