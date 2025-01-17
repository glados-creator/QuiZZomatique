<?php

declare(strict_types=1);

namespace DB;

class User {
    private string $id;
    private string $email;
    private string $nom;
    private string $prenom;
    private string $password;
    private bool $prof;

    public function __construct(string $id, string $email, string $nom, string $prenom, string $password,bool $prof) {
        $this->id = $id;
        $this->email = $email;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->password = $password;
        $this->prof = $prof;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getPrenom(): string {
        return $this->prenom;
    }

    public function getPassword(): string {
        return $this->password;
    }
    public function getProf(): bool {
        return $this->prof;
    }
}
