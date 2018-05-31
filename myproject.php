<?php
/******************************************************************************/
/*************** [POLYTECH] Web Project - Project Designer  *******************/
/************************** Année 2017-2018 ***********************************/
/******* Detcheberry Valentin - Vuillemin Anthony - Corentin TROADEC **********/
/******************************************************************************/

/**
* @file ~ myproject.php
* @descritpion ~ Interface permettant de consulter les projets et les diagrammes associés à l'utilisateur.
*/
?>
<?php session_start();?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="author" lang="fr" content="Vuillemin Anthony" />
        <link rel="stylesheet" type="text/css" href="stylesheet/default.css">
        <link rel="stylesheet" type="text/css" href="stylesheet/myproject.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <script type="text/javascript" src="js/projects.js"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
        <title>Project designer</title>
    </head>
    <body>
        <?php include("header.php"); ?>
        <section class="mainComponet">
            <h1 style="text-align:center"> My Projects </h1>

            <div id="mainDivProject">

                <div id="myprojects">

                  <div id="enteteProject">
                      <img class="expand_arrow" src="./stylesheet/pictures/expand-arrow.png" />
                      <span> Projects </span>
                      <img class="expand_arrow" src="./stylesheet/pictures/expand-arrow.png" />
                  </div>
                  <hr>

                  <div id="tabProjet">
                  </div>

                </div>

                <div id="mydiagrams">
                  <h2 id="nameProject"> Vous n'avez pas de projet pour le moment.  </h2>
                  <hr>
                </div>
               <!--   <div id="chatBox"> </div> -->
            </div>

        </section>
        <?php include 'footer.php'; ?>
        <?php echo '<script>getUserProjects('.$_SESSION['user_id'].');</script>' ?>
    </body>
</html>
