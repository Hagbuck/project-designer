<?php

namespace ProjectDesigner\Database;

use ProjectDesigner\Models\Projet;

class DAOProjet
{
    private $database;
    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUserProjects($user_id)
    {
        $projects = array();

        $query = 'SELECT * FROM Projet, Accede WHERE Accede.id_utilisateur = '.$user_id.' AND Accede.id_projet = Projet.id_projet;';
        
        $results = $this->database->query($query);

        if ($results->rowCount() < 1)
            return false;

        while($row = $results->fetch()){
            $project = new Projet($row['id_projet'], $row['nom_projet'], $row['date_creation_projet'], $row['description_projet']);
            $projects.append($project);
        }
        return $projects;
    }

    public function injectNewProject($project)
    {
        $query = 'INSERT INTO Projet(nom_projet, date_creation_projet, description_projet) VALUES(\''.$project->get_nom_projet().'\',\''.$project->get_date_creation_projet().'\',\''.$project->get_description_projet().'\')';
        $this->database->query($query);
    }
}