<?php

require_once('\src\Database\MyDatabase.php');
require_once('\src\Models\Utilisateur.php');

class DAO_utilisateur
{
    private $database;
    private $daoAddress;

    public function __construct(IDatabase $database, IDAOAddress $daoAddress)
    {
        $this->database = $database;
        $this->daoAddress = $daoAddress;
    }

    public function check($login, $password)
    {
        $results = $this->database->query(
            "SELECT pseudo_utilisateur " .
            "FROM Utilisateur WHERE " .
            "pseudo_utilisateur = '" . $login . "'" .
            " AND mdp_utilisateur = '" . $this->database->hash($password) . "';");

        return $results->rowCount() > 0;
    }

    public function getConnected()
    {
        if (!isset($_SESSION['login']))
            return false;

        $results = $this->database->query(
            "SELECT * FROM Utilisateur " .
            "WHERE pseudo_utilisateur = '" . $_SESSION['login'] . "';"
        );

        if ($results->rowCount() < 1)
            return false;

        $row = $results->fetch();

        $address = $this->daoAddress->get($row['id_lieu']);
        if (!$address)
            return false;

        $user = new User(
            $row['id_utilisateur'],
            $row['pseudo_utilisateur'],
            $row['mail_utilisateur'],
            $row['prenom_utilisateur'],
            $row['nom_utilisateur'],
            $address
        );

        return $user;
    }

    public function get($id)
    {
        if (!isset($id))
            return false;
        if (!is_numeric($id))
            return false;

        $results = $this->database->query(
            "SELECT * FROM Utilisateur " .
            "WHERE id_utilisateur = " . $id . ";"
        );

        if ($results->rowCount() < 1)
            return false;

        $row = $results->fetch();

        $address = $this->daoAddress->get($row['id_lieu']);
        if (!$address)
            return false;

        $user = new User(
            $row['id_utilisateur'],
            $row['pseudo_utilisateur'],
            $row['mail_utilisateur'],
            $row['prenom_utilisateur'],
            $row['nom_utilisateur'],
            $address
        );

        return $user;
    }

    public function add(User $user)
    {

        $this->database->query(
            "INSERT INTO utilisateur(" .
            "pseudo_utilisateur, " .
            "mail_utilisateur, " .
            "mdp_utilisateur, " .
            "prenom_utilisateur, " .
            "nom_utilisateur, " .
            "VALUES(" .
            "'" . $user->getUsername() . "', " .
            "'" . $user->getMail() . "', " .
            "'" . $this->database->hash($user->getPassword()) . "', " .
            "'" . $user->getPrenom() . "', " .
            "'" . $user->getNom()");");

        $user->setId($this->database->insertId());

        return $user;
    }

    public function exists($login) {
        $result = $this->database->query("SELECT pseudo_utilisateur FROM Utilisateur WHERE pseudo_utilisateur = '" . $login . "'");
        return $result->rowCount() > 0;
    }
}