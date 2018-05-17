<?php

/*use ProjectDesigner\Database\MyDatabase;
use ProjectDesigner\Database\DAOProjet;
use ProjectDesigner\Models\Projet;*/

include('src/Database/DAOProjet.php');

$db = new MyDatabase('localhost', 'projectdesigner', 'root', '');

$dao = new DAOProjet($db);

$projects = $dao->getUserProjects($_GET['id_utilisateur']);

echo json_encode($projects);