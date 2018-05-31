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

    public function getNameDiagramById($id)
    {
      $query = 'SELECT nom_diagramme FROM diagramme WHERE id_diagramme = '.$id.';';
      $results = $this->database->query($query);
      while($row = $results->fetch())
          $diagram = $row['nom_diagramme'];
      return $diagram;
    }

    public function getDiagramsFromProjectId($id)
    {
        $diagrams = array();

        $query = 'SELECT * FROM diagramme WHERE id_projet = '.$id.';';

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
        $query = 'INSERT INTO Diagramme(nom_diagramme, id_projet, description_diagramme) VALUES(\''.$diagram->get_nom_diagramme().'\',\''.$diagram->get_id_projet().'\',\''.$diagram->get_description_diagramme().'\')';
        $this->database->query($query);
    }

    public function delete_diagram($diagram_id)
    {
        $query = 'DELETE FROM Tag WHERE id_diagramme = ' . $diagram_id . ';';
        $this->database->query($query);

        $query = 'DELETE FROM Diagramme WHERE id_diagramme = ' . $diagram_id . ';';
        $this->database->query($query);
    }
}

?>
