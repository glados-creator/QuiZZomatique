<?php

declare(strict_types=1);

namespace DB;

class loader_json {

    // Load a single quiz from the JSON file and save it to the database
    public static function load(string $quizName, string $filePath) : void {
        // Check if the file exists
        if (!file_exists($filePath)) {
            echo "<p>FILE NOT FOUND</p>";
            die("FILE NOT FOUND");
        }

        // Load and decode the JSON data
        $data = json_decode(file_get_contents($filePath), true);

        // If the quiz name doesn't exist in the data, stop the execution
        if (!isset($data['quizzes'][$quizName])) {
            echo "<p>Quiz '$quizName' not found in the file.</p>";
            die("Quiz not found");
        }

        // Get the quiz data
        $quiz = $data['quizzes'][$quizName];

        // Save the quiz data to the database
        self::saveToDatabase($quiz);
    }

    // Save the loaded quiz data to the database
    private static function saveToDatabase(array $quiz): void {
        // Use the existing PDO instance from your pdo.php
        $pdo = \DB\PDO::getInstance(); // Adjust to your actual PDO class call

        try {
            // Prepare and execute the INSERT statement for the quiz
            $stmt = $pdo->prepare("INSERT INTO quizz (id, name, content) VALUES (?, ?, ?)");
            $stmt->execute([$quiz['id'], $quiz['name'], $quiz['content']]);

            echo "Quiz '$quiz[name]' successfully inserted into the database.\n";

        } catch (PDOException $e) {
            echo "Error saving quiz to database: " . $e->getMessage();
        }
    }
}
