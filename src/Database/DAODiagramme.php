<?php

require_once('\src\Database\MyDatabase.php');
require_once('\src\Models\Diagramme.php');

class DAODiagramme
{
    private $database;
    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getDiagramsFromProjectId($id)
    {
        $diagrams = array();
        
        $query = 'SELECT * FROM Diagramme WHERE id_project = '.$id.';';
        
        $results = $this->database->query($query);

        if ($results->rowCount() < 1)
            return false;

        while($row = $results->fetch()){
            $diagram = new Diagramme($row['id_diagramme'], $row['id_projet'], $row['nom_diagramme'], $row['description_diagramme']);
            array_push($diagrams, $diagram);
        }

        return $diagrams;
    }

    public function injectNewDiagram($diagram)
    {
        $query = 'INSERT INTO Diagramme(nom_diagramme, id_project, description_diagramme) VALUES(\''.$diagram->get_nom_diagramme().'\',\''.$diagram->get_id_projet().'\',\''.$diagram->get_description_diagramme().'\')';
        $this->database->query($query);
    }
}

?>