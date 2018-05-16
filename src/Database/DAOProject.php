<?php

namespace ProjectDesigner\Database;

use ProjectDesigner\Models\Project;
use ProjectDesigner\Models\Diagram;

class DAOProject
{
    private $database;
    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getDiagramsFromProjectId($id)
    {
        $diagrams = array();
        
        $query = 'SELECT * FROM Projet WHERE id_project = '.$id.';';
        
        $results = $this->database->query($query);

        if ($results->rowCount() < 1)
            return false;

        while($row = $results->fetch()){
            $diagram = new Project($row['id_projet'], $row['nom_projet'], $row['date_creation_projet'], $row['description_projet']);
            $diagrams.append($diagram);
        }

        return $diagrams;
    }
}