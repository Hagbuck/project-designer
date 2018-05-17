<?php

/*use ProjectDesigner\Database\MyDatabase;
use ProjectDesigner\Database\DAOProjet;
use ProjectDesigner\Models\Projet;*/
include(__DIR__.'\src\Database\DAOProjet.php');

$db = new MyDatabase('localhost', 'projectdesigner', 'root', '');

$dao = new DAOProjet($db);

$projects = $dao->getUserProjects($_GET['id_utilisateur']);

$arr_projects = array();
for($i = 0; $i < count($projects); ++$i){
    $arr_projects['#'.$i] = $projects[$i];
}
echo json_encode($arr_projects);
?>