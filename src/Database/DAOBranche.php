<?php

include('\src\Database\MyDatabase.php');
include('\src\Models\Branche.php');


class DAOBranche
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

    public function createBranches($branches)
    {
        for($i = 0; $i < count($branches); ++$i)
        {
            $query = 'INSERT INTO Branche(id_diagramme, nom_branche) VALUES('.$branches[$i]->get_id_branche().', \''.$branches[$i]->get_nom_branche().'\')';
        }
    }
}

?>