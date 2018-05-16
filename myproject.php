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
        <script type="text/javascript" src="js/tablesort.js"></script>
        <script type="text/javascript" src="js/jquery.js"></script>
        <title>Project designer</title>
    </head>
    <body>
        <?php include("header.php"); ?>
        <section class="mainComponet">
            <h1> My Projects </h1>

            <div id="mainDivProject">
                <div id="myprojects">

                  <div id="enteteProject">
                    <div id="legend">
                      <img id="imageProjet" />
                      <span style="margin-bottom:10px"> My projects </span>
                    </div>
                    <span> - </span>
                    <span> A | D </span>
                  </div>
                  <hr>
                  <div id="tabProjet"> </div>

                </div>
                <div id="mydiagrams"> </div>
                <div id="chatBox"> </div>
            </div>

        </section>
        <?php include 'footer.php'; ?>
    </body>
</html>

<!-- Pour diagram
Nom
Description
Les grands axes et collaborateurs
-->

<script>

//A faire sous forme de fonction
  var tabProjetJSON = {
      "0": {
        "name": "Projet Super",
        "date_crea": "14/05/2018",
        "description" : "Utque aegrum corpus quassari etiam levibus solet offensis, ita animus eius angustus et tener, quicquid increpuisset, ad salutis suae dispendium existimans factum aut cogitatum, insontium caedibus fecit victoriam luctuosam.",
        "admin": ["Admin", "Autre Admin"],
        "modo": ["Presque Admin", "Modo donc pas Admin"],
        "actors": ["Jean-Michel", "Michel Jean", "Vincent", "VinDeuxCent"]
      },
      "1": {
        "name": "Projet Super mais moins que le Premier",
        "date_crea": "12/05/2018",
        "description" : "Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore, discessit.",
        "admin": ["Nuri", "King"],
        "modo": ["Maudirateur"],
        "actors": ["Patrick", "Trick"]
      }
    };

  tabProjetJSON = JSON.stringify(tabProjetJSON)
  var dataProjet = JSON.parse(tabProjetJSON);
  $.each(dataProjet, function(index, value) {
    var stringAdmin = "";
    for(var i=0;i<value["admin"].length;i++)
    {
      stringAdmin += value["admin"][i]
      if(i+1 !=value["admin"].length)
        stringAdmin += ", "
      else
        stringAdmin += "."
    }


    var stringProjet = '<div class="projet"> \
      <p class="namePBlock"> <a href="#"> '+value["name"]+' </a> </p> \
      <p class="datePBlock"> <span> Créé le :</span>  '+value["date_crea"]+' </p> \
      <p class="descPBlock"> '+value["description"]+' </p> \
      <p class="adminBlock"> <span>Admin</span> : '+stringAdmin+' </p> \
    </div> \
    <hr>';
    $('#tabProjet').append(stringProjet);
});

</script>
