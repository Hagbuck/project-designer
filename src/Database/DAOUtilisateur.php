<?php

require_once(__DIR__ . '/MyDatabase.php');
require_once(__DIR__ . '/../Models/Utilisateur.php');

class DAOUtilisateur
{
    private $database;
    public function __construct($database)
    {
        $this->database = $database;
    }

    public function create_user($user)
    {
        $query = 'INSERT INTO Utilisateur(nom_utilisateur, prenom_utilisateur, pseudo_utilisateur, mdp_utilisateur, mail_utilisateur) VALUES(\''.$user->get_nom_utilisateur().'\', \''.$user->get_prenom_utilisateur().'\', \''.$user->get_pseudo_utilisateur().'\', \''.$user->get_mdp_utilisateur().'\', \''.$user->get_mail_utilisateur().'\');';

        $this->database->query($query);
    }

    public function get_user_with_pseudo($pseudo)
    {
        $query = 'SELECT * FROM Utilisateur WHERE pseudo_utilisateur = \''.$pseudo.'\';';

        $results = $this->database->query($query);

        $row = $results->fetch();

        if($row != false)
        {
            return new Utilisateur($row['id_utilisateur'],
                            $row['pseudo_utilisateur'],
                            $row['mail_utilisateur'],
                            $row['prenom_utilisateur'],
                            $row['nom_utilisateur'],
                            $row['mdp_utilisateur']);
        }
        return null;
    }

    public function is_user_already_exist($pseudo)
    {
        $query = 'SELECT COUNT(*) AS exist FROM Utilisateur WHERE pseudo_utilisateur = \''.$pseudo.'\';';

        $result = $this->database->query($query);
        $row = $result->fetch();

        if($row['exist'] != 0)
            return true;
        return false;
    }
}