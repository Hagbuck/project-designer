<?php
/******************************************************************************/
/*************** [POLYTECH] Web Project - Project Designer  *******************/
/************************** Année 2017-2018 ***********************************/
/******* Detcheberry Valentin - Vuillemin Anthony - Corentin TROADEC **********/
/******************************************************************************/

/**
* @file ~ traitement.php
* @descritpion ~ Page Script gérant les requêtes AJAX et assurant leur réponse.
*/
?>
<?php

//SESSION
session_start();

//REQUIREMENTS
require_once(__DIR__.'/src/Database/DAOBranche.php');
require_once(__DIR__.'/src/Database/DAODiagramme.php');
require_once(__DIR__.'/src/Database/DAOProjet.php');
require_once(__DIR__.'/src/Database/DAOTag.php');
require_once(__DIR__.'/src/Database/DAOUtilisateur.php');
require_once("conf/conf.php");

//VAR
$db = new MyDatabase(DB_HOST,DB_NAME,DB_USER,DB_MDP);

//ON VERIFIE QUE $_POST['fonction'] CONTIENT QUELQUE CHOSE
// NOTE : $_POST['fonction'] contient un flag pour savoir quelle fonction éxéctuée.
if(isset($_POST['fonction']))
{

    //CREATION D'UN PROJET
    switch($_POST['fonction'])
    {
        case 'createProject':
            $dao = new DAOProjet($db);
            $date = date('Y-m-d');
            $projet = new Projet(0, $_POST['nom_projet'], $date, $_POST['description_projet']);
            $dao->createNewProjectWithUserAccess($projet, $_POST['user_id'], 1, 1);
            echo "DONE";
        break;

        //RECUPERATION DES PROJETS ASSOCIES A UN UTILISATEUR (JSON)
        case 'getUserProjects':
            $dao = new DAOProjet($db);
            $projects = $dao->getUserProjects($_POST['user_id']);
            $arr_projects = array();
            for($i = 0; $projects && $i < count($projects); ++$i){
                $arr_projects['#'.$i] = $projects[$i];
            }
            echo json_encode($arr_projects);
        break;

        //CREATION D'UN DIAGRAMME
        case 'createDiagram':
            $dao = new DAODiagramme($db);
            $diagram = new Diagramme(0, $_POST['id_projet'], $_POST['nom_diagramme'], $_POST['description_diagramme']);
            $dao->injectNewDiagram($diagram);
            echo "DONE";
        break;

        //RECUPERATION DES DIAGRAMMES APPARTENANT A UN PROJET (JSON)
        case 'getProjectDiagrams':
            $dao = new DAODiagramme($db);
            $diagrams = $dao->getDiagramsFromProjectId($_POST['project_id']);
            $arr_diagrams = array();
            for($i = 0;$diagrams && $i < count($diagrams); ++$i){
                $arr_digrams['#'.$i] = $diagrams[$i];
            }
            echo json_encode($diagrams);
        break;

        //RECUPERATION DU NOM D'UN DIAGRAMME EN FONCTION DE SON ID
        case 'getNameDiagramById':
            $dao = new DAODiagramme($db);
            $diagram = $dao->getNameDiagramById($_POST['digramme_id']);
            echo $diagram;
        break;

        //RECUPERATION DU NOM D'UN PROJET EN FONCTION DE SON ID
        case 'getNameProjectById':
            $dao = new DAOProjet($db);
            $projet = $dao->getNameProjectById($_POST['projet_id']);
            echo $projet;
        break;

        //ENREGISTREMENT D'UNE NOUVELLE BRANCHE D'UN DIAGRAMME EN BASE DE DONNEES
        case 'createBranch':
            $dao = new DAOBranche($db);
            $branch = new Branche(0, $_POST['digramme_id'], $_POST['nom_branche']);
            $dao->injectNewBranch($branch);
            echo "DONE";
        break;

        //SUPPRESION D'UN  BRANCHE D'UN DIAGRAMME EN BASE DE DONNEES
        case 'delBranch':
            $dao = new DAOBranche($db);
            $branch = $dao->getBranchesFromDiagramIdAndName($_POST['digramme_id'],$_POST['nom_branche']);
            $dao->delBranch($branch);
            echo "DONE";
        break;

        //RECUPERATION DES BRANCHES D'UN DIAGRAMME (JSON)
        case 'getBranch':
            $dao = new DAOBranche($db);
            $branches = $dao->getBranchesFromDiagramId($_POST['diagramme_id']);
            $arr_branches = array();
            for($i = 0; $i < count($branches); ++$i){
                $arr_branches['#'.$i] = $branches[$i];
            }
            echo json_encode($arr_branches);
        break;

        //ENREGISTREMENT D'UN NOUVEAU TAG D'UN DIAGRAMME EN BASE DE DONNEES
        case 'createTag':
            $dao = new DAOTag($db);
            $tag = new Tag(0, $_POST['id_diagramme'], $_POST['texte_tag'], $_POST['pos_x_tag'], $_POST['pos_y_tag'], $_POST['couleur_tag']);
            $dao->createTag($tag);
            $last_tag = $dao->getLastTagInjectedFromDiagramId($_POST['id_diagramme']);
            if($last_tag != false)
                echo json_encode($last_tag);
            else
                echo "FAILED";
        break;

        //MODIFICATION D'UN TAG D'UN DIAGRAMME EN BASE DE DONNEES
        case 'updateTag':
            $dao = new DAOTag($db);
            $tag = new Tag($_POST['tag_id'], $_POST['id_diagramme'], $_POST['texte_tag'], $_POST['pos_x_tag'], $_POST['pos_y_tag'], $_POST['couleur_tag']);
            $dao->updateTag($tag);
            echo json_encode($tag);
        break;

        //SUPPRESION D'UN TAG D'UN DIAGRAMME EN BASE DE DONNEES
        case 'removeTag':
            $dao = new DAOTag($db);
            $dao->removeTag($_POST['tag_id']);
            echo "DONE";
        break;

        //RECUPERATION D'UN TAG D'UN DIAGRAMME (JSON)
        case 'getTags':
            $dao = new DAOTag($db);
            $tags = $dao->getBranchesFromDiagramId($_POST['diagramme_id']);
            $arr_tags = array();
            for($i = 0; $i < count($tags); ++$i){
                $arr_tags['#'.$i] = $tags[$i];
            }
            echo json_encode($arr_tags);
        break;

        //VERIFIE LES IDENTIFIANTS D'UN UTILISATEUR VOULANT SE CONNECTER
        case 'testConnexion':
            $dao = new DAOUtilisateur($db);

            if($dao->is_user_already_exist($_POST['pseudo'])) // Si le pseudo existe.
            {
                $user = $dao->get_user_with_pseudo($_POST['pseudo']);

                if(sha1($_POST['pass']) == $user->get_mdp_utilisateur())
                {
                    echo "SUCCESS";

                    //SESSION
                    $_SESSION['user_pseudo'] = $user->get_pseudo_utilisateur();
                    $_SESSION['user_id'] = $user->get_id_utilisateur();
                    $_SESSION['user_name'] = $user->get_nom_utilisateur();
                    $_SESSION['user_prenom'] = $user->get_prenom_utilisateur();
                    //Autre variables de sessions ?
                }
                else // si couple pseudo/mdp incorrect
                    echo 'FAIL';
            }
            else
              echo "FAIL";
        break;

        //FONCTION DE LOGOUT DU SITE (DESCTRUCTION DE LA SESSION)
        case 'logOut':
          session_destroy();
          echo "SUCCESS";
        break;

        //TENTE L'INSCRIPTION D'UN UTILISATEUR
        case 'inscription':
            if(!empty($_POST['pseudo']))
            {
                if($_POST['pass'] == $_POST['passC']) // vérification mdp
                {
                    $user = new Utilisateur(0, $_POST['pseudo'], $_POST['mail'], $_POST['prenom'], $_POST['nom'], sha1($_POST['pass']));

                    $dao = new DAOUtilisateur($db);
                    $dao->create_user($user);

                    $user = $dao->get_user_with_pseudo($user->get_pseudo_utilisateur());
                    if($user != null)
                    {
                        echo "DONE";
                        $_SESSION['user_pseudo'] = $user->get_pseudo_utilisateur();
                        $_SESSION['user_id'] = $user->get_id_utilisateur();
                        $_SESSION['user_name'] = $user->get_nom_utilisateur();
                        $_SESSION['user_prenom'] = $user->get_prenom_utilisateur();
                    }
                    else
                        echo 'FAIL';
                }
                else
                    echo 'Wrong passwords correspondance.';
            }
        break;

        case 'addContributor':
            $dao = new DAOProjet($db);

            if($dao->add_user_to_project($_POST['nom_utlisateur'], $_POST['id_projet']))
                echo 'SUCCESS';
            else
                echo 'UNKNOW';
        break;

        case 'removeContributor':
            $dao = new DAOProjet($db);

            if($dao->remove_user_from_project($_POST['nom_utlisateur'], $_POST['id_projet']))
                echo 'SUCCESS';
            else
                echo 'UNKNOW';
        break;

        case 'removeProject':
            $dao = new DAOProjet($db);
            $dao->delete_project($_POST['id_projet']);
            echo 'SUCCESS';
        break;

        case 'removeDiag':
            $dao = new DAODiagramme($db);
            $dao->delete_diagram($_POST['id_diagramme']);
            echo 'SUCCESS';
        break;

        //COMMANDE INCONNUE
        default:
            echo "UNKNOW COMMAND";
        break;
    }
}
?>
