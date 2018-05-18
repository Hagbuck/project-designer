<?php

require_once('\src\Database\MyDatabase.php');
require_once('\src\Models\Branche.php');


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

        $query = 'SELECT * FROM branche WHERE id_diagramme = '.$id.';';

        $results = $this->database->query($query);

        if ($results->rowCount() < 1)
            return false;

        while($row = $results->fetch()){
            $branch = new Branche($row['id_branche'], $row['id_diagramme'], $row['nom_branche']);
            array_push($branches,$branch);
        }

        return $branches;
    }

    public function injectNewBranch($branch)
    {
      $query = 'INSERT INTO Branche(id_diagramme, nom_branche) VALUES('.$branch->get_id_diagramme().', \''.$branch->get_nom_branche().'\')';
      $this->database->query($query);
    }

    public function createBranches($branches)
    {
        for($i = 0; $i < count($branches); ++$i)
        {
            $query = 'INSERT INTO Branche(id_diagramme, nom_branche) VALUES('.$branches[$i]->get_id_branche().', \''.$branches[$i]->get_nom_branche().'\')';
            $this->database->query($query);
        }
    }
}

?>
