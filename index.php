<?php
/******************************************************************************/
/*************** [POLYTECH] Web Project - Project Designer  *******************/
/************************** Année 2017-2018 ***********************************/
/******* Detcheberry Valentin - Vuillemin Anthony - Corentin TROADEC **********/
/******************************************************************************/

/**
* @file ~ index.php
* @descritpion ~ Page d'accueil du Site Web
*/
?>
<?php session_start();?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="author" lang="fr" content="Vuillemin Anthony" />
        <link rel="stylesheet" type="text/css" href="stylesheet/default.css">
        <link rel="stylesheet" type="text/css" href="stylesheet/index.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <script type="text/javascript" src="js/jquery.js"></script>
        <title>Project Designer - Main Page</title>
    </head>
    <body>
        <?php include("header.php"); ?>
        <section class="mainComponet">
            <h1>Project Designer</h1>

            <p>
                <h2> Qu'est ce que c'est ? </h2>

                <span clas="projectName">Project Designer</span> est un site web collaboratif ayant pour but de faciliter l'élaboration de vos projets.
                <br>Nous mettons à votre disponibilités des outils de pré-conception dans le but de vous accompagner tout au long de cette phase.
                <br /><br />

                <h2> Créez... Editez... Organisez... Partagez ! </h2>

                <p>
                Partagez vos diagrammes avec vos collaborateurs et choisissez en groupe quels seront les points les plus importants de votre futur projet.
                <br> Regroupez vos idées par grandes thématiques afin d'en avoir une vue globale. Déplacez les éléments ou vous voulez et personnalisez les comme vous voulez.
                <br> C'est vous qui choisissez comment et avec qui convevoir votre projet !
                </P>

                <div id="foot_index">
                  <h2>Alors, qu'attendez vous ? Transformez dès maintenant vos idées en projet !</h2>
                  <img onclick="display_inscriptionIHM()" id="sign_in" src="stylesheet/pictures/sign_in.png" />
                </div>
            </p>
        </section>
        <?php include 'footer.php'; ?>
    </body>
</html>
