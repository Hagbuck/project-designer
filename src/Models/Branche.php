<?php

class Branche implements JsonSerializable
{
    private $id_branche;
    private $id_diagramme;
    private $nom_branche;

    public function __construct($id_branche,
                                $id_diagramme,
                                $nom_branche)
    {
        $this->id_branche = $id_branche;
        $this->id_diagramme = $id_diagramme;
        $this->nom_branche = $nom_branche;
    }

    public function get_id_branche(){
        return $this->id_branche;
    }

    public function get_id_diagramme(){
        return $this->id_diagramm;
    }

    public function get_nom_branche(){
        return $this->nom_branche;
    }

    public function jsonSerialize()
    {
        return array("id_branche" =>$this->id_branche,
                    "id_diagramme" => $this->id_diagramme,
                    "nom_branche" => $this->nom_branche);
    }
}

?>
