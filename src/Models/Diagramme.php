<?php

namespace ProjectDesigner\Models;

class Diagramme
{
    private $id_diagramme;
    private $id_projet;
    private $nom_diagramme;
    private $date_creation_diagramme;
    private $description_diagramme;

    public function __construct($id_diagramme,
                                $id_projet,
                                $nom_diagramme,
                                $description_diagramme)
    {
        $this->id_diagramme = $id_diagramme;
        $tthis->id_projet = $id_projet;
        $this->nom_diagramme = $nom_diagramme;
        $this->description_diagramme = $description_diagramme;
    }

    public function get_id_diagramme()
    {
        return $this->id_diagramme;
    }

    public function get_id_projet()
    {
        return $this->id_projet;
    }

    public function get_nom_diagramme()
    {
        return $this->nom_diagramme;
    }

    public function get_description_diagramme()
    {
        return $this->description_diagramme;
    }
}