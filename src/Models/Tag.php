<?php

class Tag implements JsonSerializable
{
    private $id_tag;
    private $id_diagramme;
    private $texte_tag;
    private $pos_x_tag;
    private $pos_y_tag;
    private $couleur_tag;

    public function __construct($id_tag,
                                $id_diagramme,
                                $texte_tag,
                                $pos_x_tag,
                                $pos_y_tag,
                                $couleur_tag)
    {

        $this->id_tag = $id_tag;
        $this->id_diagramme = $id_diagramme;
        $this->texte_tag = $texte_tag;
        $this->pos_x_tag = $pos_x_tag;
        $this->pos_y_tag = $pos_y_tag;
        $this->couleur_tag = $couleur_tag;
    }


    public function get_id_tag()
    {
        return $this->id_tag;
    }

    public function get_id_diagramme()
    {
        return $this->id_diagramme;
    }

    public function get_text_tag()
    {
        return $this->texte_tag;
    }

    public function get_pos_x_tag()
    {
        return $this->pos_x_tag;
    }

    public function get_pos_y_tag()
    {
        return $this->pos_y_tag;
    }

    public function get_couleur_tag()
    {
        return $this->couleur_tag;
    }

    public function jsonSerialize()
    {
        return array("id_tag" =>$this->id_tag,
                    "id_diagramme" => $this->id_diagramme,
                    "texte_tag" => $this->texte_tag,
                    "pos_x_tag" => $this->pos_x_tag,
                    "pos_y_tag" => $this->pos_y_tag,
                    "couleur_tag" => $this->couleur_tag);
    }
}

?>
