<!-- [POLYTECH] Web diagram - diagram Designer  -->
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

        <form method="post" action="create_new_diagram.php">
            <input type="hidden" id="id_project" name="id_project" value=<?php echo '"'.$_GET['id_project'].'"'; ?>>

            <label for="nom_diagram">Diagram name : </label>
            <input type="text" name="nom_diagram" id="nom_diagram"> <br />

            <label for="description_diagram">Diagram description : </label>
            <input type="text" name="description_diagram" id="description_diagram"> <br />

            <input type="submit">
        </form>

        <?php include("footer.php"); ?>
    </body>
</html>