<!-- [POLYTECH] Web Project - Project Designer  -->
<!-- 2017 - 2018                                -->
<!-- Detcheberry Valentin - Vuillemin Anthony - Troadec Corentin  -->

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
            <h1>Inscription</h1>
                <form method="post" action="traitement.php">
                    <p>
                        <label>Votre pseudo</label> : <input type="text" name="pseudo" />
                    </p>
                    <p>
                        <label>Votre adresse mail</label> : <input type="text" name="mail" />
                    </p>
                    <p>
                        <label>Votre mot de passe</label> : <input type="text" name="mdp1" />
                    </p>
                    <p>
                        <label>Confirmez votre mot de passe</label> : <input type="text" name="mdp2" />
                    </p>
                    <p>
                        <label>Votre nom</label> : <input type="text" name="nom" />
                    </p>
                    <p>
                        <label>Votre prénom</label> : <input type="text" name="prenom" />
                    </p>
                    <p>
                        <label>Votre pseudo</label> : <input type="text" name="pseudo" />
                    </p>
                    <p>
                        <input type="submit" name="M'inscrire" />
                    </p>
                </form>
        </section>
        <?php include 'footer.php'; ?>
    </body>
</html>

<?php

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

?>