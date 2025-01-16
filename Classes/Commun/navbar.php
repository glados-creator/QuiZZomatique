<header>
    <nav>
        <ul>
            <li><a href="/src/index.php"><img src="static/logo.png" alt="logo.png"></a></li>
            
            <ul style="flex-wrap : wrap;">

                <li>
                    <?php 
                if ( false ) { //is_login()) { 
                    echo "<form action='../src/compte/connection.php'>";
                    echo "<input type='submit' value='mon compte'>";
                }
                else {
                    echo "<form action='../src/compte/connection.php' method='post'>";
                    echo "<input type='submit' name='boutton' value='se connecter'>";
                    echo "<input type='submit' name='boutton' value='crée un compte'>";
                }
                echo "</form>";
                ?>
                </form>
            </li>
            <li>
                <form action="../src/Quizz.php">
                    <input type="submit" value="Quizz">
                </form>
            </li>
        </ul>
        </ul>
    </nav>
</header>