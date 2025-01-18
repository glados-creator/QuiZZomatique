<?php

declare(strict_types=1);

namespace DB;

class Quizz {
    private string $id;
    private string $name;
    private string $content;

    public function __construct(string $id, string $name, string $content) {
        $this->id = $id;
        $this->name = $name;
        $this->content = $content;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getContent(): string {
        return $this->content;
    }
}
