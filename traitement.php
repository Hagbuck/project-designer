<?php

include(__DIR__.'\src\Database\DAOProjet.php');

$db = new MyDatabase('localhost', 'projectdesigner', 'root', '');

if(isset($_POST['fonction']))
{
    if($_POST['fonction'] == 'createProject')
    {
        $dao = new DAOProjet($db);
        $date = date('Y-m-d');
        $projet = new Projet(0, $_POST['nom_projet'], $date, $_POST['description_projet']);

        $dao->createNewProjectWithUserAccess($projet, $_POST['user_id'], 1, 1);

        echo "DONE";
    }

    else if($_POST['fonction'] == 'getUserProjects')
    {
        $dao = new DAOProjet($db);

        $projects = $dao->getUserProjects($_POST['user_id']);

        $arr_projects = array();
        for($i = 0; $i < count($projects); ++$i){
            $arr_projects['#'.$i] = $projects[$i];
        }
        echo json_encode($arr_projects);
    }

  else
    echo "UNKNOW COMMAND";
}
?>