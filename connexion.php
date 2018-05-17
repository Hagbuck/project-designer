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
                <form method="post" action="connexion.php">
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