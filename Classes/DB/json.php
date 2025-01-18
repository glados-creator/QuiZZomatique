<?php

declare(strict_types=1);

namespace DB;


class json {
    public static function load(string $filePath): void {
        if (!file_exists($filePath)) {
            echo "FILE NOT FOUND\n";
            die("FILE NOT FOUND");
        }

        $data = json_decode(file_get_contents($filePath), true);

        self::saveToDatabase($data);
    }

    private static function saveToDatabase(array $quiz): void {
        $pdo = \DB\sql::getInstance()->pdo;

        try {
            $stmt = $pdo->prepare("INSERT INTO quizz (id, name, content) VALUES (?, ?, ?)");
            $stmt->execute([$quiz['id'], $quiz['name'], $quiz['content']]);

            echo "Quiz '{$quiz['name']}' successfully inserted into the database.\n";

        } catch (\PDOException $e) {
            echo "Error saving quiz to database: " . $e->getMessage();
        }
    }
}
