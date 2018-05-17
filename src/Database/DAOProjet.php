<?php

/*namespace ProjectDesigner\Database;*/

/*use ProjectDesigner\Models\Projet;*/

include('\src\Database\MyDatabase.php');
include('\src\Models\Projet.php');

class DAOProjet
{
    private $database;
    public function __construct($database)
    {
        $this->database = $database;
    }

    public function getUserProjects($user_id)
    {
        $projects = array();

        $query = 'SELECT * FROM Projet, Accede WHERE Accede.id_utilisateur = '.$user_id.' AND Accede.id_projet = Projet.id_projet;';

        echo $query . '<br />';
        
        $results = $this->database->query($query);

        if ($results->rowCount() < 1)
            return false;

        while($row = $results->fetch()){
            $project = new Projet($row['id_projet'], $row['nom_projet'], $row['date_creation_projet'], $row['description_projet']);
            array_push($projects, $project);
        }

        return $projects;
    }

    public function injectNewProject($project)
    {
        $query = 'INSERT INTO Projet(nom_projet, date_creation_projet, description_projet) VALUES(\''.$project->get_nom_projet().'\',\''.$project->get_date_creation_projet().'\',\''.$project->get_description_projet().'\')';
        $this->database->query($query);
    }

    public function get_last_project_inserted()
    {
        $query = 'SELECT MAX(id_project) FROM Projet;';
        $this->database->query($query);
        if ($results->rowCount() < 1)
            return false;

        return $results->feth()['id_project'];
    }

    public function createNewProjectWithUserAccess($project, $user_id, $admin, $modo)
    {
        injectNewProject($project);
        $id_project = get_last_project_inserted();
        $query = 'INSERT INTO Accede(id_project, id_utilisateur, est_admin, est_moderateur) VALUES('.$id_project.', '.$user_id.', '.$admin.', '.$modo.');';
        $this->database->query($query);
    }
}

?>