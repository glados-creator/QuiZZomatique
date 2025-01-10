<?php
declare(strict_types=1);

namespace commun;

class user {
    public $email;
    public $nom;
    public function __construct(string $email,string $nom,string $prenom){
        $this->email = $email;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

}
