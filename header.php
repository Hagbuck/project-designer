<?php
/******************************************************************************/
/*************** [POLYTECH] Web Project - Project Designer  *******************/
/************************** Année 2017-2018 ***********************************/
/******* Detcheberry Valentin - Vuillemin Anthony - Corentin TROADEC **********/
/******************************************************************************/

/**
* @file ~ header.php
* @descritpion ~ Header par défaut du site.
*/
?>
<script src="js/sweetalert2.js"></script>
<script type="text/javascript" src="js/connexion_inscription.js"></script>
<header>
        <nav id="menu">
            <ul>
                <a href="index.php"><li>Home</li></a>
                <?php
                  if(isset($_SESSION['user_pseudo']))
                    echo "<a href='myproject.php'><li>My Projects</li></a>";
                ?>
            </ul>
            <ul id="rightNavBar">
              <?php
                if(isset($_SESSION['user_pseudo']))
                  echo "<a href='#'><li>Utilsateur : ".$_SESSION['user_pseudo']." </li></a><a href='#' onclick='logOut()'><li> Log Out </li></a>";
                else
                  echo "<a href='#' onclick='display_connexionIHM()'><li>Login</li></a><a href='#' onclick='display_inscriptionIHM()'><li>Sign In</li></a>";
              ?>
            </ul>
        </nav>
</header>
