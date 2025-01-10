<?php
class user {
    public $email;
    public $nom;
    public function __construct(string $email,string $nom,string $prenom){
        $this->email = $email;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

}