<!-- [POLYTECH] Web Project - Project Designer  -->
<!-- 2017 - 2018                                -->
<!-- Detcheberry Valentin - Vuillemin Anthony - Corentin TROADEC   -->

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="author" lang="fr" content="Vuillemin Anthony" />
        <link rel="stylesheet" type="text/css" href="stylesheet/default.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <title>Project designer</title>
    </head>
    <body>
        <?php include("header.php"); ?>

        <form method="post" action="create_new_project.php">
            <label for="nom_project">Project name : </label>
            <input type="text" name="nom_project" id="nom_project"> <br />

            <label for="description_project">Project description : </label>
            <input type="text" name="description_project" id="description_project"> <br />

            <input type="submit">
        </form>

        <?php include("footer.php"); ?>
    </body>
</html>