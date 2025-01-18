<?php
// Create PDO connection
try {
    $pdo = new PDO("sqlite:db.quizz");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to the database server successfully.\n";
    

    // Create user table
    $userTable = "CREATE TABLE IF NOT EXISTS user (
        id VARCHAR(50) PRIMARY KEY,
        email VARCHAR(100) NOT NULL,
        nom VARCHAR(20) NOT NULL,
        prenom VARCHAR(20) NOT NULL,
        password VARCHAR(64) NOT NULL
    )";

    // Create quiz table
    $quizzTable = "CREATE TABLE IF NOT EXISTS quizz (
        id VARCHAR(20) PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        content TEXT NOT NULL
    )";

    // Create answerquizz table (removing the resultat table)
    $answerquizzTable = "CREATE TABLE IF NOT EXISTS answerquizz (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id VARCHAR(50) NOT NULL,
        quizz_id VARCHAR(20) NOT NULL,
        answer TEXT,
        FOREIGN KEY (user_id) REFERENCES user(id),
        FOREIGN KEY (quizz_id) REFERENCES quizz(id)
    )";

    // Execute the table creation queries
    $pdo->exec($userTable);
    $pdo->exec($quizzTable);
    $pdo->exec($answerquizzTable);

    echo "Tables 'user', 'quizz', and 'answerquizz' created or already exist in the database.\n";
    echo($pdo->exec("SELECT * FROM user"));
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
