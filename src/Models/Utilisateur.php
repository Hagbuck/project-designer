<?php

namespace ProjectDesigner\Models;

class User
{
    private $id;
    private $pseudo;
    private $mail;
    private $nom;
    private $prenom;
    private $mdp;

    public function __construct($id,
                                $pseudo,
                                $mail,
                                $prenom,
                                $nom,
                                $mdp)
    {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->mail = $mail;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->mdp = $mdp;
    }
}