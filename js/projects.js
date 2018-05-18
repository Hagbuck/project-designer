/*******************************************************/
/***************** RECUPERATION PROJET *****************/
/*******************************************************/

/******* REQUEST AJAX *******/
function getUserProjects()
{
  $.ajax({
     url : "traitement.php",
     type : 'POST',
     data : 'fonction=getUserProjects&user_id=1',
     dataType : "json",
     success  : function(data){getUserProjectsCallBackSuccess(data)},
     error : function(resultat, statut, erreur){console.log("[ERROR] -> Fail to getUserProjects()");console.log(erreur)}
    });
}

/**** RESPONSE AJAX ****/
async function getUserProjectsCallBackSuccess(code_html)
{
  if(code_html != "ERROR")
  {
    console.log("[INFO] -> Success of getUserProjects()");
    display_projects(code_html);
    var default_project = most_recent_project(code_html)
    get_diagrames(default_project[0],default_project[1])
  }
  else
  {
    console.log("[ERROR] -> Fail to getUserProjects().\n"+code_html);
    display_projects(JSON.stringify({}));
  }
}


/**** DISPLAY PROJECTS ******/
function display_projects(stringJSON)
{
  var dataProjet = stringJSON;

  $.each(dataProjet, function(index, value) {


    var stringAdmin = "";
    /*
    for(var i=0;i<value["admin"].length;i++)
    {
      stringAdmin += value["admin"][i]
      if(i+1 !=value["admin"].length)
        stringAdmin += ", "
      else
        stringAdmin += "."
    }
*/
    var stringProjet = '<div class="projet"> \
      <p class="namePBlock" onclick="get_diagrames(\''+value['id_projet']+'\',\''+value['nom_projet']+'\')">  '+value["nom_projet"]+' </p> \
      <p class="datePBlock"> <span> Créé le :</span>  '+value["date_creation_projet"]+' </p> \
      <p class="descPBlock"> '+value["description_projet"]+' </p> \
      <p class="adminBlock"> <span>Admin</span> : '+stringAdmin+' </p> \
    </div> \
    <hr style="margin-bottom:10px">';
    $('#tabProjet').append(stringProjet);
});
$('#tabProjet').append('<div id="addProjectButton" onclick="create_project()"> <span>+</span> </div><hr style="margin-top: 10px;">');
}


function most_recent_project(stringJSON)
{

  var dataProjet = stringJSON;

  var id_max = -1
  var date_max = new Date(0,0,0);
  var name_max = null;

  $.each(dataProjet, function(index, value) {
    var splitdate = value["date_creation_projet"].split("-");
    var date = new Date(splitdate[0],splitdate[1],splitdate[2]);
    if(date >date_max)
    {
      id_max = value["id_projet"]
      date_max = date
      name_max =  value["nom_projet"]
    }
});
  return [id_max,name_max];

}

/*******************************************************/
/*************** RECUPERATION DIAGRAME *****************/
/*******************************************************/

/******* REQUEST AJAX *******/
function get_diagrames(idProject,nom_projet)
{
  $(".diagram").remove();
  $("#addDiagramButton").remove();
  $("#mydiagrams").children("hr").remove();
  $('#mydiagrams').append("<hr>");
  $("#nameProject").html(nom_projet)

  var alldiag = document.getElementById("mydiagrams")
  alldiag.getElementsByTagName("hr")

  $.ajax({
     url : "traitement.php",
     type : 'POST',
     data : 'fonction=getProjectDiagrams&project_id='+idProject,
     dataType : "json",
     success  : function(data){
       console.log(data)
       display_diagrames(data,idProject)},
     error : function(resultat, statut, erreur){console.log("[ERROR] -> Fail to getProjectDiagrams()");console.log(erreur)}
    });

}

/**** DISPLAY DIAGRAM ******/
function display_diagrames(dataDiagram,idProject)
{
 console.log("[INFO] -> Success to getProjectDiagrams()")
 console.log(dataDiagram)

  $.each(dataDiagram, function(index, value) {

    /*
      var stringContributeur = "";
      for(var i=0;i<value["contributors"].length;i++)
      {
        stringContributeur += value["contributors"][i]
        if(i+1 !=value["contributors"].length)
          stringContributeur += ", "
        else
          stringContributeur += "."
      }
      */
      /*
      var stringBranche = "";
      for(var i=0;i<value["keys"].length;i++)
      {
        stringBranche += value["keys"][i]
        if(i+1 !=value["keys"].length)
          stringBranche += ", "
        else
          stringBranche += "."
      }

      var stringDiagram = ' <div class="diagram"> \
                              <div class="diagName"> <span>'+value["name"]+'</span> </div> \
                              <div class="diagInfo">\
                                <p class="diagkeys"> <span>Branches</span>  :  '+stringBranche+' </p> <br/>\
                                <p class="diagDesc"> <span>Description</span> :'+value["description"]+' </p> <br/>\
                                <p class="contributors"> <span>Contribueurs</span> : '+stringContributeur+'. </p>\
                              </div>\
                          </div>\
      <hr style="margin-bottom:10px">';
      */
      var stringDiagram = ' <div class="diagram"> \
                              <a class="diagName" href="workspace.php?project='+value["id_projet"]+'&diag='+value["id_diagramme"]+'"><div> <span>'+value["nom_diagramme"]+'</span></div> </a> \
                              <div class="diagInfo">\
                                <p class="diagDesc"> <span>Description</span> :'+value["description_diagramme"]+' </p> <br/>\
                              </div>\
                          </div>\
      <hr style="margin-bottom:10px">';

      $('#mydiagrams').append(stringDiagram);

});
$('#mydiagrams').append('<div id="addDiagramButton" onclick="create_diagram(\''+idProject+'\')"> <span>+</span> </div><hr style="margin-bottom:10px">');
}



/*******************************************************/
/******************* CREATION PROJET *******************/
/*******************************************************/
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


async function tenta_crea(name,desc)
{
  var user = 1

  if(name != "" && name !=undefined && desc != "" && desc !=undefined)
  {
    $.ajax({
       url : "traitement.php",
       type : 'POST',
       data : 'fonction=createProject&user_id='+user+"&nom_projet="+name+"&description_projet="+desc,
       success : function(code_html, statut){
         if(code_html == "DONE")
          swal({type: 'success',title: 'Le projet a bien été créé.',timer:3000})
        else
         swal({type: 'error', title: 'Un problème est survenue.',html:code_html});
       },
       error : function(resultat, statut, erreur){swal({type: 'error',title: 'Un problème est survenue.',html:erreur})}
      });
    return true;
  }

  else {
    swal({type: 'error',title: 'Syntaxe Incorrect',timer:5000})
    return false;
  }
}


/*******************************************************/
/****************** CREATION DIAGRAME ******************/
/*******************************************************/

async function create_diagram(id_projet)
{
  var id_user = 1
  const {value: name,value :desc} = await swal({
    title: 'Nouveau Diagramme',
    html:
      '<input id="diagName" class="swal2-input" placeholder="Nom diagramme">' +
      '<textarea id="diagDesc" class="swal2-textarea" placeholder="Description du diagramme...">',
    focusConfirm: false,
    preConfirm: (name,desc) => tenta_crea_diag($(diagName).val(),$(diagDesc).val(),id_projet)
  })
}


async function tenta_crea_diag(name,desc,id_projet)
{

  var user = 1

  if(name != "" && name !=undefined && desc != "" && desc !=undefined && id_projet >= 0)
  {
    $.ajax({
       url : "traitement.php",
       type : 'POST',
       data : 'fonction=createDiagram&id_projet='+id_projet+"&nom_diagramme="+name+"&description_diagramme="+desc,
       success : function(code_html, statut){
         if(code_html == "DONE")
         {
             swal({type: 'success',title: 'Le diagramme a bien été créé.',timer:3000})
             document.location.href="myproject.php";
         }
        else
         swal({type: 'error', title: 'Un problème est survenue.',html:code_html});
       },
       error : function(resultat, statut, erreur){swal({type: 'error',title: 'Un problème est survenue.',html:erreur})}
      });
    return true;
  }

  else {
    swal({type: 'error',title: 'Syntaxe Incorrect',timer:5000})
    return false;
  }
}
