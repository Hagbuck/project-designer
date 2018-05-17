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
                    <input type="hidden" name="fonction" id="fonction" value="inscription" />
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
                        <input type="submit" value="M'inscrire" />
                    </p>
                </form>
        </section>
        <?php include('footer.php'); ?>
    </body>
</html>