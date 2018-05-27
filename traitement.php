<?php
//SESSION
session_start();

require_once(__DIR__.'\src\Database\DAOBranche.php');
require_once(__DIR__.'\src\Database\DAODiagramme.php');
require_once(__DIR__.'\src\Database\DAOProjet.php');
require_once(__DIR__.'\src\Database\DAOTag.php');

$db = new MyDatabase('localhost', 'projectdesigner', 'root', 'mysql');

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

    else if($_POST['fonction'] == 'createDiagram')
    {
        $dao = new DAODiagramme($db);
        $diagram = new Diagramme(0, $_POST['id_projet'], $_POST['nom_diagramme'], $_POST['description_diagramme']);

        $dao->injectNewDiagram($diagram);
        echo "DONE";
    }

    else if($_POST['fonction'] == 'getProjectDiagrams')
    {

        $dao = new DAODiagramme($db);
        $diagrams = $dao->getDiagramsFromProjectId($_POST['project_id']);

        $arr_diagrams = array();
        for($i = 0; $i < count($diagrams); ++$i){
            $arr_digrams['#'.$i] = $diagrams[$i];
        }

        echo json_encode($diagrams);
    }

    else if($_POST['fonction'] == 'getNameDiagramById')
    {

        $dao = new DAODiagramme($db);
        $diagram = $dao->getNameDiagramById($_POST['digramme_id']);
        echo $diagram;
    }

    else if($_POST['fonction'] == 'getNameProjectById')
    {
        $dao = new DAOProjet($db);
        $projet = $dao->getNameProjectById($_POST['projet_id']);
        echo $projet;
    }



    else if($_POST['fonction'] == 'createBranch')
    {
        $dao = new DAOBranche($db);
        $branch = new Branche(0, $_POST['digramme_id'], $_POST['nom_branche']);

        $dao->injectNewBranch($branch);

        echo "DONE";
    }

    else if($_POST['fonction'] == 'delBranch')
    {
        $dao = new DAOBranche($db);
        $branch = $dao->getBranchesFromDiagramIdAndName($_POST['digramme_id'],$_POST['nom_branche']);

        $dao->delBranch($branch);

        echo "DONE";
    }

    else if($_POST['fonction'] == 'getBranch')
    {
        $dao = new DAOBranche($db);
        $branches = $dao->getBranchesFromDiagramId($_POST['diagramme_id']);

        $arr_branches = array();
        for($i = 0; $i < count($branches); ++$i){
            $arr_branches['#'.$i] = $branches[$i];
        }
        echo json_encode($arr_branches);
    }

    else if($_POST['fonction'] == 'createTag')
    {
        $dao = new DAOTag($db);
        $tag = new Tag(0, $_POST['id_diagramme'], $_POST['texte_tag'], $_POST['pos_x_tag'], $_POST['pos_y_tag'], $_POST['couleur_tag']);
        $dao->createTag($tag);

        $last_tag = $dao->getLastTagInjectedFromDiagramId($_POST['id_diagramme']);
        if($last_tag != false)
            echo json_encode($last_tag);
        else
            echo "FAILED";
    }

    else if($_POST['fonction'] == 'updateTag')
    {
        $dao = new DAOTag($db);
        $tag = new Tag($_POST['tag_id'], $_POST['id_diagramme'], $_POST['texte_tag'], $_POST['pos_x_tag'], $_POST['pos_y_tag'], $_POST['couleur_tag']);

        $dao->updateTag($tag);

        echo json_encode($tag);
    }

    else if($_POST['fonction'] == 'removeTag')
    {
        $dao = new DAOTag($db);
        $dao->removeTag($_POST['tag_id']);

        echo "DONE";
    }

    else if($_POST['fonction'] == 'getTags')
    {
        $dao = new DAOTag($db);
        $tags = $dao->getBranchesFromDiagramId($_POST['diagramme_id']);

        $arr_tags = array();
        for($i = 0; $i < count($tags); ++$i){
            $arr_tags['#'.$i] = $tags[$i];
        }
        echo json_encode($arr_tags);
    }

    else if($_POST['fonction'] == 'testConnexion')
    {
        mysql_connect("localhost", "root", "mysql");
        mysql_select_db("projectdesigner");
        $pseudo = mysql_real_escape_string(htmlspecialchars($_POST['pseudo']));
        $mdp = mysql_real_escape_string(htmlspecialchars($_POST['pass']));

        // cryptage mdp
        //$mdp = sha1($mdp);

        $nbre = mysql_query("SELECT COUNT(*) AS exist FROM utilisateur WHERE pseudo_utilisateur='$pseudo'");
        $donnees = mysql_fetch_array($nbre);

        if($donnees['exist'] != 0) // Si le pseudo existe.
        {
            $requete = mysql_query("SELECT * FROM utilisateur WHERE pseudo_utilisateur='$pseudo'");
            $infos = mysql_fetch_array($requete);
            if($mdp == $infos['mdp_utilisateur'])
            {
                echo "SUCCESS";
                // On s'amuse à créer quelques variables de session dans $_SESSION
                $_SESSION['user_pseudo'] = $pseudo;
                //Autre variables de sessions ?
            }
            else // si couple pseudo/mdp incorrect
            {
                echo 'FAIL';
            }
        }

        else {
          echo "FAIL";
        }

    }


    else if($_POST['fonction'] == 'logOut')
    {
      session_destroy();
      echo "SUCCESS";
    }

    else if ($_POST['fonction'] == 'inscription')
    {
        if(!empty($_POST['pseudo']))
        {
            //connection BD
            mysql_connect("localhost", "root", "");
            mysql_select_db("projectdesigner");

            $mdp1 = mysql_real_escape_string(htmlspecialchars($_POST['mdp1']));
            $mdp2 = mysql_real_escape_string(htmlspecialchars($_POST['mdp2']));
            if($mdp1 == $mdp2) // vérification mdp
            {
                $pseudo = mysql_real_escape_string(htmlspecialchars($_POST['pseudo']));
                $mail = mysql_real_escape_string(htmlspecialchars($_POST['mail']));
                // cryptage mdp :
                //$mdp1 = sha1($mdp1);

                mysql_query("INSERT INTO Utilisateur VALUES('', '$nom', '$prenom', '$pseudo', '$mdp1', '$mail')");
            }

            else
            {
                echo 'Les deux mots de passe que vous avez rentrés ne correspondent pas.';
            }
        }

    }

  else
    echo "UNKNOW COMMAND";
}
?>
