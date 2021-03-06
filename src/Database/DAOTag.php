<?php

require_once(__DIR__ . '/MyDatabase.php');
require_once(__DIR__ . '/../Models/Tag.php');

class DAOTag
{
    private $database;
    public function __construct($database)
    {
        $this->database = $database;
    }

    public function createTag($tag)
    {
        $query = 'INSERT INTO Tag(id_diagramme, texte_tag, pos_x_tag, pos_y_tag, couleur_tag) VALUES('.$tag->get_id_diagramme().', \''.$tag->get_text_tag().'\', '.$tag->get_pos_y_tag().', '.$tag->get_pos_y_tag().', \''.$tag->get_couleur_tag().'\');';
        $this->database->query($query);
    }

    public function removeTag($tag_id)
    {
        $query = 'DELETE FROM Tag WHERE id_tag = '.$tag_id.' ;';
        $this->database->query($query);
    }

    public function updateTag($tag)
    {
        $query = 'UPDATE Tag SET pos_x_tag = '.$tag->get_pos_x_tag().', pos_y_tag = '.$tag->get_pos_y_tag().', texte_tag=\''.$tag->get_text_tag().'\', couleur_tag = \''.$tag->get_couleur_tag().'\' WHERE id_tag = '.$tag->get_id_tag().' ;';
        $this->database->query($query);
    }

    public function getBranchesFromDiagramId($diagram_id)
    {
        $tags = array();

        $query = 'SELECT * FROM Tag WHERE id_diagramme = ' .$diagram_id. ';';

        $results = $this->database->query($query);

        if ($results->rowCount() < 1)
            return false;

        while($row = $results->fetch()){
            $tag = new Tag($row['id_tag'], $row['id_diagramme'], $row['texte_tag'], $row['pos_x_tag'], $row['pos_y_tag'], $row['couleur_tag']);
            array_push($tags, $tag);
        }

        return $tags;
    }

    public function getLastTagInjectedFromDiagramId($diagram_id)
    {

        $query = 'SELECT * FROM Tag WHERE id_diagramme = '.$diagram_id.' ORDER BY id_tag DESC LIMIT 1;';

        $results = $this->database->query($query);

        if ($results->rowCount() < 1)
            return false;

        $row = $results->fetch();
        return new Tag($row['id_tag'], $row['id_diagramme'], $row['texte_tag'], $row['pos_x_tag'], $row['pos_y_tag'], $row['couleur_tag']);
    }
}

?>
