<?php

declare(strict_types=1);

namespace DB;

use PDO;
use PDOException;

class sql {
    private static $instance = null;
    private $pdo;

    private function __construct(string $host, string $dbname, string $username, string $password) {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance(): sql {
        if (self::$instance === null) {
            $host = getenv("DBHOST") ?: "localhost";
            $dbname = getenv("DBNAME") ?: "your_db_name";
            $username = getenv("DBUSER") ?: "root";
            $password = getenv("DBPASS") ?: "";

            self::$instance = new self($host, $dbname, $username, $password);
        }

        return self::$instance;
    }

    private function load(string $query, array $params = []): array {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    private function save(string $query, array $params = []): void {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
    }

    public function addUser(string $nom, string $prenom, string $password, string $email): void {
        $hashedPassword = sha1($password);
        $query = "INSERT INTO user (nom, prenom, password, email) VALUES (?, ?, ?, ?)";
        $this->save($query, [$nom, $prenom, $hashedPassword, $email]);
    }

    public function authenticateUser(string $email, string $password): ?User {
        $query = "SELECT * FROM user WHERE email = ? AND password = ?";
        $result = $this->load($query, [$email, sha1($password)]);
        if ($result) {
            return new User($result[0]['id'], $result[0]['email'], $result[0]['nom'], $result[0]['prenom'], $result[0]['password']);
        }
        return null;
    }

    public function getAllQuizzes(): array {
        $query = "SELECT * FROM quizz";
        $result = $this->load($query);
        $quizzes = [];
        foreach ($result as $row) {
            $quizzes[] = new Quizz($row['id'], $row['name'], $row['content']);
        }
        return $quizzes;
    }

    public function addQuizz(Quizz $quizz): void {
        $query = "INSERT INTO quizz (id, name, content) VALUES (?, ?, ?)";
        $this->save($query, [$quizz->getId(), $quizz->getName(), $quizz->getContent()]);
    }

    public function addAnswer(AnswerQuizz $answer): void {
        $query = "INSERT INTO answer_quizz (user_id, quizz_id, answer) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE answer = ?";
        $this->save($query, [$answer->getUserId(), $answer->getQuizzId(), $answer->getAnswer(), $answer->getAnswer()]);
    }

    public function getAnswers(string $userId, string $quizzId): ?array {
        $query = "SELECT * FROM answer_quizz WHERE user_id = ? AND quizz_id = ?";
        $result = $this->load($query, [$userId, $quizzId]);
        if ($result) {
            return new AnswerQuizz($result[0]['user_id'], $result[0]['quizz_id'], $result[0]['answer']);
        }
        return null;
    }
}
