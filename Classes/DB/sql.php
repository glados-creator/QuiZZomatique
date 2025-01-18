<?php

declare(strict_types=1);

namespace DB;

class sql {
    private static $instance = null;
    public PDO $pdo;

    private function __construct(string $bd) {
        $this->pdo = new PDO("sqlite:'.$bd.'");
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    public static function getInstance(): sql {
        if (self::$instance === null) {
            self::$instance = new self("db.quiz");
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
        echo'l\'utilisateur n\'existe pas';
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

    public function getAnswers(string $quizzId): ?AnswerQuizz {
        $userId = $_SESSION["user"]->getId();
        $query = "SELECT * FROM answer_quizz WHERE user_id = ? AND quizz_id = ?";
        $result = $this->load($query, [$userId, $quizzId]);
        if ($result) {
            return new AnswerQuizz($result[0]['user_id'], $result[0]['quizz_id'], $result[0]['answer']);
        }
        return null;
    }
}
