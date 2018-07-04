<?php

require_once(__DIR__ . '/MyDatabase.php');
require_once(__DIR__ . '/../Models/Projet.php');

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

        $query = 'SELECT * FROM Projet, Accede WHERE Accede.id_utilisateur = '.$user_id.' AND Accede.id_projet = Projet.id_projet ORDER BY date_creation_projet DESC;';

        //echo $query . '<br />';

        $results = $this->database->query($query);

        if ($results->rowCount() < 1)
            return false;

        while($row = $results->fetch()){
            $project = new Projet($row['id_projet'], $row['nom_projet'], $row['date_creation_projet'], $row['description_projet']);
            array_push($projects, $project);
        }

        return $projects;
    }


    public function getNameProjectById($id)
    {
      $query = 'SELECT nom_projet FROM Projet WHERE id_projet = '.$id.';';
      $results = $this->database->query($query);
      while($row = $results->fetch())
          $projet = $row['nom_projet'];
      return $projet;
    }

    public function injectNewProject($project)
    {
        $query = 'INSERT INTO Projet(nom_projet, date_creation_projet, description_projet) VALUES(\''.$project->get_nom_projet().'\',\''.$project->get_date_creation_projet().'\',\''.$project->get_description_projet().'\')';
        $this->database->query($query);
    }

    public function get_last_project_inserted()
    {
        $query = 'SELECT MAX(id_projet) as id_projet FROM Projet;';
        $results = $this->database->query($query);
        if ($results->rowCount() < 1)
            return false;
        $row = $results->fetch();
        return $row['id_projet'];
    }

    public function createNewProjectWithUserAccess($project, $user_id, $admin, $modo)
    {
        $this->injectNewProject($project);
        $id_project = $this->get_last_project_inserted();
        $query = 'INSERT INTO Accede(id_projet, id_utilisateur, est_admin, est_moderateur) VALUES('.$id_project.', '.$user_id.', '.$admin.', '.$modo.');';
        $this->database->query($query);
    }

    public function get_all_user_pseudo_accessing($project_id)
    {
        $query = 'SELECT Utilisateur.pseudo_utilisateur as pseudo
        FROM Accede, Utilisateur
        WHERE Accede.id_project = ' . $project_id . '
        AND Accede.id_utilisateur = Utilisateur.id_utilisateur;';

        $result = $this->database->query($query);

        $all_pseudo = '';

        while($row = $result->fetch())
        {
            $all_pseudo += $row['pseudo'] . ';';
        }
        return $all_pseudo;
    }

    public function add_user_to_project($pseudo, $project_id)
    {
        $query = 'SELECT id_utilisateur FROM Utilisateur WHERE pseudo_utilisateur = \'' . $pseudo . '\';';
        $result = $this->database->query($query);
        $row = $result->fetch();

        if($row != false) // L'utilisateur existe
        {
            $id_user = $row['id_utilisateur'];

            $query = 'SELECT * FROM Accede WHERE id_utilisateur = ' . $id_user . ' AND id_projet = '.$project_id.';';
            $result = $this->database->query($query);
            $row = $result->fetch();

            if($row == false) // L'utilisateur n'est pas dans le projet
            {
                $query = 'INSERT INTO Accede(id_projet, id_utilisateur, est_admin, est_moderateur) VALUES('.$project_id.', '.$id_user.', 1, 1);';
                $this->database->query($query);
            }
            return true;
        }
        return false;
    }

    public function remove_user_from_project($pseudo, $project_id)
    {
        $query = 'SELECT id_utilisateur FROM Utilisateur WHERE pseudo_utilisateur = \'' . $pseudo . '\';';
        $result = $this->database->query($query);
        $row = $result->fetch();

        if($row != false) // L'utilisateur existe
        {
            $id_user = $row['id_utilisateur'];
            $query = 'DELETE FROM Accede WHERE id_projet = ' . $project_id . ' AND id_utilisateur = ' . $id_user . ';';
            $this->database->query($query);
            return true;
        }
        return false;
    }

    public function delete_project($project_id)
    {
        // FOR EACH DIAGRAM
        $query = 'SELECT id_diagramme FROM Diagramme WHERE id_projet = ' . $project_id . ';';
        $result = $this->database->query($query);
        while($row = $result->fetch())
        {
            // DELETE Diagramme tags
            $query = 'DELETE FROM Tag WHERE id_diagramme = ' . $row['id_diagramme'] . ';';
            $this->database->query($query);
        }

        // DELETE ALL DIAGRAMS
        $query = 'DELETE FROM Diagramme WHERE id_projet = ' . $project_id . ';';
        $this->database->query($query);

        // DELETE ALL Accede
        $query = 'DELETE FROM Accede WHERE id_projet = ' . $project_id . ';';
        $this->database->query($query);

        // DELETE PROJET
        $query = 'DELETE FROM Projet WHERE id_projet = ' . $project_id . ';';
        $this->database->query($query);
    }
}

?>
