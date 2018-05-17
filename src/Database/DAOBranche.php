<?php

namespace ProjectDesigner\Database;

use ProjectDesigner\Models\Branche;

class DAOBranch
{
    private $database;
    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getBranchesFromDiagramId($id)
    {
        $branches = array();
        
        $query = 'SELECT * FROM Branche WHERE id_diagramme = '.$id.';';
        
        $results = $this->database->query($query);

        if ($results->rowCount() < 1)
            return false;

        while($row = $results->fetch()){
            $branch = new Branche($row['id_branche'], $row['id_projet'], $row['nom_diagramme'], $row['description_diagramme']);
            $branches.append($branch);
        }

        return $branches;
    }
}