<!-- [POLYTECH] Web Project - Project Designer  -->
<!-- 2017 - 2018                                -->
<!-- Detcheberry Valentin - Vuillemin Anthony - Corentin TROADEC   -->

<!DOCTYPE html>

<!-- RAJOUT CONVERT CANVA EN MODELE IMPRIMABLE
+ font awseaome  -->
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
                  <h2 id="nameProject"> Project Name  </h2>
                  <hr>
                </div>
               <!--   <div id="chatBox"> </div> -->
            </div>

        </section>
        <?php include 'footer.php'; ?>
    </body>
</html>


<script>
      getUserProjects();
</script>
