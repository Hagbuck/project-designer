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
                    <div id="legend">
                      <img id="imageProjet" />
                      <span style="margin-bottom:10px"> My projects </span>
                    </div>
                    <span> - </span>
                    <span> A | D </span>
                  </div>
                  <hr>

                  <div id="tabProjet">
                  </div>

                </div>

                <div id="mydiagrams">
                  <h2 id="nameProject"> Project Name  </h2>
                  <hr>
                </div>
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
  var tabProjetJSON = {
      "0": {
        "id" : "1",
        "name": "Projet Super",
        "date_crea": "17/05/2018",
        "description" : "Utque aegrum corpus quassari etiam levibus solet offensis, ita animus eius angustus et tener, quicquid increpuisset, ad salutis suae dispendium existimans factum aut cogitatum, insontium caedibus fecit victoriam luctuosam.",
        "admin": ["Admin", "Autre Admin"],
        "modo": ["Presque Admin", "Modo donc pas Admin"],
        "actors": ["Jean-Michel", "Michel Jean", "Vincent", "VinDeuxCent"]
      },
      "1": {
        "id" : "2",
        "name": "Projet Super mais moins que le Premier",
        "date_crea": "12/05/2018",
        "description" : "Duplexque isdem diebus acciderat malum, quod et Theophilum insontem atrox interceperat casus, et Serenianus dignus exsecratione cunctorum, innoxius, modo non reclamante publico vigore, discessit.",
        "admin": ["Nuri", "King"],
        "modo": ["Maudirateur"],
        "actors": ["Patrick", "Trick"]
      }
    };


    var tabDiagJSON = {
        "0": {
          "id" : "10",
          "name": "MainGraph",
          "projectid" : "1",
          "description" : "Occurrere hastisque cunctorum quorum certamen.",
          "keys": ["Univers", "Gameplay","Technologie"],
          "contributors": ["Dieu", "Dieu de Dieu"]
        },
        "1": {
          "id" : "15",
          "name": "Détails Univers",
          "projectid" : "1",
          "description" : "Principem eius quas diu in itineribus itineribus sollemni ob pompa.",
          "keys": ["Histoire", "Contexte","Scénarion"],
          "contributors": ["Dieu", "Moi"]
        },
        "2": {
          "id" : "23",
          "name": "MainGraph",
          "projectid" : "2",
          "description" : "Diligendi quo et nosmet ut in qui amicitia benevolentia in.",
          "keys": ["Budget", "Tasks","Organisation","Main d'oeuvre"],
          "contributors": ["Toi", "Moi","Gregory"]
        }
      };

    display_projects(tabProjetJSON);
    var default_project = most_recent_project(tabProjetJSON)
    display_diagrames(tabDiagJSON,default_project[0],default_project[1])

    function get_diagrams(id,nom)
    {
      display_diagrames(tabDiagJSON,id,nom);
    }

    async function create_project()
    {
      var id_user = 1
      const {value: name,value :desc} = await swal({
        title: 'Nouveau Projet',
        html:
          '<input id="projectName" class="swal2-input" placeholder="Nom projet">' +
          '<textarea id="projetDesc" class="swal2-textarea" placeholder="Description du projet...">',
        focusConfirm: false,
        preConfirm: (name,desc) => tenta_crea($(projectName).val(),$(projetDesc).val())
      })
    }
</script>
