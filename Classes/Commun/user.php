<?php
class user {
    public $email;
    public $nom;
    public $panier;
    public function __construct(string $email,string $nom){
        $this->email = $email;
        $this->nom = $nom;
    }

}