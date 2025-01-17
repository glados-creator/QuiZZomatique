<?php

declare(strict_types=1);

namespace DB;

class AnswerQuizz {
    private string $userId;
    private string $quizzId;
    private string $answer;

    public function __construct(string $userId, string $quizzId, string $answer) {
        $this->userId = $userId;
        $this->quizzId = $quizzId;
        $this->answer = $answer;
    }

    public function getUserId(): string {
        return $this->userId;
    }

    public function getQuizzId(): string {
        return $this->quizzId;
    }

    public function getAnswer(): string {
        return $this->answer;
    }
}
