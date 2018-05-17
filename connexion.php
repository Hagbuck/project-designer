<!-- [POLYTECH] Web Project - Project Designer  -->
<!-- 2017 - 2018                                -->
<!-- Detcheberry Valentin - Vuillemin Anthony  - Troadec Corentin -->

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
        <section class="mainComponet">
            <h1>Connexion</h1>
                <form method="post" action="traitement.php">
                    <p>
                        <label>Pseudo</label> : <input type="text" name="pseudo" />
                    </p>
                    <p>
                        <label>Mot de passe</label> : <input type="text" name="mdp" />
                    </p>
                </form>
        </section>
        <?php include 'footer.php'; ?>
    </body>
</html>

<?php
    mysql_connect("localhost", "root", "");
    mysql_select_db("projectdesigner");
    $pseudo = mysql_real_escape_string(htmlspecialchars($_POST['pseudo']));
    $mdp = mysql_real_escape_string(htmlspecialchars($_POST['mdp']));

    // cryptage mdp
    //$mdp = sha1($mdp);

    $nbre = mysql_query("SELECT COUNT(*) AS exist FROM connexion WHERE pseudo='$pseudo'");
    $donnees = mysql_fetch_array($nbre);
    if($donnees['exist'] != 0) // Si le pseudo existe.
    {
        $requete = mysql_query("SELECT * FROM connexion WHERE pseudo='$pseudo'");
        $infos = mysql_fetch_array($requete);
        if($mdp == $infos['passe'])
        {
            //CONNEXION
        }
        else // si couple pseudo/mdp incorrect
        {
            echo 'Vous n\'avez pas rentré les bons identifiants';
        }
    }
?>
