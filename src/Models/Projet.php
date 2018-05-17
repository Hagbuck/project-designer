<?php

namespace ProjectDesigner\Models;

class Project
{
    private $id_projet;
    private $nom_projet;
    private $date_creation_projet;
    private $description_projet;

    public function __construct($id_projet,
                                $nom_projet,
                                $date_creation_projet,
                                $description_projet)
    {
        $this->id_projet = $id_projet;
        $this->nom_projet = $nom_projet;
        $this->date_creation_projet = $date_creation_projet;
        $this->description_projet = $description_projet;
    }

    public function get_id_projet()
    {
        return $this->id_projet;
    }

    public function get_nom_projet()
    {
        return $this->nom_projet;
    }

    public function get_date_creation_projet()
    {
        return $this->date_creation_projet;
    }

    public function get_description_projet()
    {
        return $this->description_projet;
    }
}