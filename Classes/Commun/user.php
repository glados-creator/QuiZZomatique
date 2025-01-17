<?php
declare(strict_types=1);

namespace Commun;

class user {
    public $id;
    public $email;
    public $nom;
    public $prenom;
    public $password;

    public function __construct(string $email, string $nom, string $prenom, string $password) {
        $this->email = $email;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->password = hash('sha256', $password); // Hashing password using SHA-256
        $this->id = uniqid(); // Generate unique ID
    }
}
