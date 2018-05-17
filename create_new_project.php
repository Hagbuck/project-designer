<?php

include(__DIR__.'\src\Database\DAOProjet.php');

$db = new MyDatabase('localhost', 'projectdesigner', 'root', '');

$dao = new DAOProjet($db);

$date = date('Y-m-d');

echo 'Date ' + $date;
$projet = new Projet(0, 'Test_projet 2', $date, 'Ceci est un projet test 2');

$dao->injectNewProject($projet);

echo 'fin';
?>