<?php

class Utilisateur implements JsonSerializable
{
    private $id_utilisateur;
    private $pseudo_utilisateur;
    private $mail_utilisateur;
    private $nom_utilisateur;
    private $prenom_utilisateur;
    private $mdp_utilisateur;

    public function __construct($id_utilisateur,
                                $pseudo_utilisateur,
                                $mail_utilisateur,
                                $prenom_utilisateur,
                                $nom_utilisateur,
                                $mdp_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
        $this->pseudo_utilisateur = $pseudo_utilisateur;
        $this->mail_utilisateur = $mail_utilisateur;
        $this->nom_utilisateur = $nom_utilisateur;
        $this->prenom_utilisateur = $prenom_utilisateur;
        $this->mdp_utilisateur = $mdp_utilisateur;
    }

    public function get_id_utilisateur()
    {
        return $this->id_utilisateur;
    }

    public function get_pseudo_utilisateur()
    {
        return $this->pseudo_utilisateur;
    }

    public function get_mail_utilisateur()
    {
        return $this->mail_utilisateur;
    }

    public function get_nom_utilisateur()
    {
        return $this->nom_utilisateur;
    }

    public function get_prenom_utilisateur()
    {
        return $this->prenom_utilisateur;
    }

    public function get_mdp_utilisateur()
    {
        return $this->mdp_utilisateur;
    }

    public function jsonSerialize()
    {
        return array("id_utilisateur" =>$this->id_utilisateur,
                    "pseudo_utilisateur" => $this->pseudo_utilisateur,
                    "mail_utilisateur" => $this->mail_utilisateur,
                    "nom_utilisateur" => $this->nom_utilisateur,
                    "prenom_utilisateur" => $this->prenom_utilisateur);
    }
}