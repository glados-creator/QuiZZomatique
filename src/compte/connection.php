<?php
include_once "../commun/commun.php";
include_once "../commun/header.php";
include_once "../commun/navbar.php";
?>
<div class="flex" style="justify-content: space-around;">

    <?php if($_POST['boutton']=='crée un compte'): ?>
    <div style="border: 1px solid; border-radius: 20%;">
        <h1>se crée un compte</h1>
        <form action="../compte/connection_next.php" method="post">
            <input type="nom" name="nom" value="nom">
            <input type="email" name="email" value="email">
            <input type='submit'></form>
        </form>
    </div>
    <?php endif ?>

    <?php if($_POST['boutton'] == 'se connecter'): ?>
    <div style="border: 1px solid;border-radius: 20%;">
        <h1>j'ai un compte</h1>
        <form action="../compte/connection_next.php" method="post">
            <input type="nom" name="nom" value="nom">
            <input type="email" name="email" value="email">
            <input type='submit'></form>
        </form>
    </div>
    <?php endif ?>
</div>

<?php

include_once "../commun/footer.php";
