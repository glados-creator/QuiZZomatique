<header>
    <nav>
        <ul>
            <li><a href="/src/index.php"><img src="static/logo.png" alt="logo.png"></a></li>
            
            <ul style="flex-wrap : wrap;">

                <li>
                    <?php 
                if ( false ) { //is_login()) { 
                    echo "<form action='../src/compte.php'>";
                    echo "<input type='submit' value='mon compte'>";
                } else {
                    echo "<form action='../src/connection.php'>";
                    echo "<input type='submit' value='se connecter'>";
                    echo "<input type='submit' value='crée un compte'>";
                }
                echo "</form>";
                ?>
                </form>
            </li>
            <li>
                <form action="../src/panier.php">
                    <input type="submit" value="mon panier">
                </form>
            </li>
        </ul>
        </ul>
    </nav>
</header>