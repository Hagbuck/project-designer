/******************************************************************************/
/*************** [POLYTECH] Web Project - Project Designer  *******************/
/************************** Année 2017-2018 ***********************************/
/******* Detcheberry Valentin - Vuillemin Anthony - Corentin TROADEC **********/
/******************************************************************************/

/**
* @file ~ projet.js
* @descritpion ~ Fonction contenant les fonctions de récupération et d'affichages des projet & diagrammes.
*/

/*******************************************************/
/***************** RECUPERATION PROJET *****************/
/*******************************************************/

/******* REQUEST AJAX *******/
function getUserProjects(id_user)
{
  $.ajax({
     url : "traitement.php",
     type : 'POST',
     data : 'fonction=getUserProjects&user_id='+id_user,
     dataType : "json",
     success  : function(data){getUserProjectsCallBackSuccess(data,id_user)},
     error : function(resultat, statut, erreur){console.log("[ERROR] -> Fail to getUserProjects()");console.log(erreur)}
    });
}

/**** RESPONSE AJAX ****/
async function getUserProjectsCallBackSuccess(code_html,id_user)
{
  if(code_html != "ERROR")
  {
    console.log("[INFO] -> Success of getUserProjects()");
    display_projects(code_html,id_user);
    var default_project = most_recent_project(code_html)
    get_diagrames(default_project[0],default_project[1])
  }
  else
  {
    console.log("[ERROR] -> Fail to getUserProjects().\n"+code_html);
    display_projects(JSON.stringify({}),id_user);
  }
}


/**** DISPLAY PROJECTS ******/
function display_projects(stringJSON,id_user)
{
  var dataProjet = stringJSON;
  console.log(dataProjet);

  if(dataProjet["#0"] != null)
  {
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
        <p class="adminBlock"> <span>Admin</span> : '+stringAdmin+' </p>  <br> \
        <p class="project_action">  \
          <i title="Ajouter un contributeur." class="fas fa-user-plus" onclick="addContributor('+value["id_projet"]+')"></i> \
          <i title="Supprimer un contributeur." class="fas fa-user-minus" onclick="removeContributor('+value["id_projet"]+')"></i>  \
          <i title="Supprimer le projet." class="fas fa-trash-alt"  onclick="removeProject('+value["id_projet"]+')"></i> </p> \
      </div> \
      <hr style="margin-bottom:10px">';
      $('#tabProjet').append(stringProjet);
  });
  }
  else
  {
    $('#mydiagrams').append('<div id="noproject"> <span> Vous n\'avez aucun projet, vous ne pouvez donc pas créer de diagramme. </div><hr style="margin-bottom:10px"></span>');
  }

$('#tabProjet').append('<div id="addProjectButton" onclick="create_project('+id_user+')"> <span>+</span> </div><hr style="margin-top: 10px;">');
}


function most_recent_project(stringJSON)
{

  var dataProjet = stringJSON;
  var id_max = -1
  var date_max = new Date(0,0,0);
  var name_max = null;


if(stringJSON["#0"] != null)
{
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

}

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

 if(dataDiagram["0"] != null)
 {
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
                                 <p class="diagDesc"> <span>Description</span> :'+value["description_diagramme"]+' </p>  \
                                 <p class="supressDiag">  <i title="Supprimer le diagramme." class="fas fa-trash-alt"  onclick="removeDiag('+value["id_diagramme"]+')"></i> <br/>\
                               </div>\
                           </div>\
       <hr style="margin-bottom:10px">';

       $('#mydiagrams').append(stringDiagram);


   });
   $('#mydiagrams').append('<div id="addDiagramButton" onclick="create_diagram(\''+idProject+'\')"> <span>+</span> </div><hr style="margin-bottom:10px">');
 }
 else if(idProject != -1)
     $('#mydiagrams').append('<div id="addDiagramButton" onclick="create_diagram(\''+idProject+'\')"> <span>+</span> </div><hr style="margin-bottom:10px">');


}



/*******************************************************/
/******************* CREATION PROJET *******************/
/*******************************************************/
async function create_project(id_user)
{
  const {value: name,value :desc} = await swal({
    title: 'Nouveau Projet',
    html:
      '<input id="projectName" class="swal2-input" placeholder="Nom projet">' +
      '<textarea id="projetDesc" class="swal2-textarea" placeholder="Description du projet...">',
    focusConfirm: false,
    preConfirm: (name,desc) => tenta_crea($(projectName).val(),$(projetDesc).val(),id_user)
  })
}


async function tenta_crea(name,desc,user_id)
{

  if(name != "" && name !=undefined && desc != "" && desc !=undefined & name.indexOf(';') < 0  & desc.indexOf(';') < 0)
  {
    $.ajax({
       url : "traitement.php",
       type : 'POST',
       data : 'fonction=createProject&user_id='+user_id+"&nom_projet="+name+"&description_projet="+desc,
       success : function(code_html, statut){
         if(code_html == "DONE")
         {
           swal({type: 'success',title: 'Le projet a bien été créé.',timer:3000});
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


/*******************************************************/
/****************** CREATION DIAGRAME ******************/
/*******************************************************/

async function create_diagram(id_projet)
{
  const {value: name,value :desc} = await swal({
    title: 'Nouveau Diagramme',
    html:
      '<input id="diagName" class="swal2-input" placeholder="Nom diagramme">' +
      '<textarea id="diagDesc" class="swal2-textarea" placeholder="Description du diagramme...">',
    focusConfirm: true,
    preConfirm: (name,desc) => tenta_crea_diag($(diagName).val(),$(diagDesc).val(),id_projet)
  })
}


async function tenta_crea_diag(name,desc,id_projet)
{

  if(name != "" && name !=undefined && desc != "" && desc !=undefined && id_projet >= 0 & name.indexOf(';') < 0  & desc.indexOf(';') < 0)
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

/*******************************************************/
/**************** GESTION DES PROJETS ******************/
/*******************************************************/

//AJOUT CONTRIBUTEUR
async function addContributor(idprojet)
{
  const {value: name} = await swal({
    title: 'Ajouter un contributeur',
    html:
      '<input id="contributorName" class="swal2-input" placeholder="Nom du contributeur">',
    focusConfirm: true,
    preConfirm: (name) => tenta_addContributor(idprojet,$(contributorName).val())
  })
}

async function tenta_addContributor(idprojet,nameUser)
{
  //console.log(idprojet,nameUser)
  if(nameUser != "" && nameUser !=undefined && nameUser.indexOf(';') < 0 )
  {
    $.ajax({
       url : "traitement.php",
       type : 'POST',
       data : 'fonction=addContributor&id_projet='+idprojet+"&nom_utlisateur="+nameUser,
       success : function(code_html, statut){
         if(code_html == "DONE")
         {
             swal({type: 'success',title: 'Le contributor a bien été ajouté au projet.',timer:3000})
             document.location.href="myproject.php";
         }

         else if(code_html == "UNKNOW")
           swal({type: 'error',title: 'Le contributor a ajouté n\'existe pas.',timer:3000})

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

//SUPPRESION CONTRIBUTEUR
async function removeContributor(idprojet)
{
  const {value: name} = await swal({
    title: 'Suppresion d\'un contributeur',
    html:
      '<input id="contributorName" class="swal2-input" placeholder="Nom du contributeur">',
    focusConfirm: true,
    preConfirm: (name) => tenta_removeContributor(idprojet,$(contributorName).val())
  })
}

async function tenta_removeContributor(idprojet,nameUser)
{
  //console.log(idprojet,nameUser)
  if(nameUser != "" && nameUser !=undefined && nameUser.indexOf(';') < 0 )
  {
    $.ajax({
       url : "traitement.php",
       type : 'POST',
       data : 'fonction=removeContributor&id_projet='+idprojet+"&nom_utlisateur="+nameUser,
       success : function(code_html, statut){
         if(code_html == "DONE")
         {
             swal({type: 'success',title: 'Le contributor a bien été supprimé du projet.',timer:3000})
             document.location.href="myproject.php";
         }

         else if(code_html == "UNKNOW")
           swal({type: 'error',title: 'Le contributor a supprimé n\'existe pas.',timer:3000})

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


//SUPPRESION DU PROJET
function removeProject(idProjet)
{
  swal({
  title: 'Suppresion du projet.',
  text: "Voulez-vous vraiment supprimer ce projet ?",
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Confirmer',
  cancelButtonText : 'Annuler'
}).then((result) => {

  if (result.value) {
    //AJAX
    $.ajax({
       url : "traitement.php",
       type : 'POST',
       data : 'fonction=removeProject&id_projet='+idProjet,
       dataType : "text",
       success  : function(data){
         console.log(data)
         parseDataRemoveProject(data)
       },
       error : function(resultat, statut, erreur)
       {
         console.log("[ERROR] -> Fail to removeProject()");
         console.log(erreur)
         swal({
             type: 'error',
             title: 'Erreur Serveur',
             text: erreur
           })

       }
      });
  }
})
}

function parseDataRemoveProject(data)
{
  if(data=="SUCCESS")
      document.location.href="myproject.php"

  else
  {
    swal({
        type: 'error',
        title: 'Un problème est survenue',
        html: data
      })
  }
}


//SUPPRESION Diagramme
function removeDiag(id_diagramme)
{
    swal({
    title: 'Suppresion du diagramme.',
    text: "Voulez-vous vraiment supprimer ce diagramme ?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Confirmer',
    cancelButtonText : 'Annuler'
  }).then((result) => {

    if (result.value) {
      //AJAX
      $.ajax({
         url : "traitement.php",
         type : 'POST',
         data : 'fonction=removeDiag&id_diagramme='+id_diagramme,
         dataType : "text",
         success  : function(data){
           console.log(data)
           parseDataRemoveDiag(data)
         },
         error : function(resultat, statut, erreur)
         {
           console.log("[ERROR] -> Fail to removeDiag()");
           console.log(erreur)
           swal({
               type: 'error',
               title: 'Erreur Serveur',
               text: erreur
             })

         }
        });
    }
  })
}

function parseDataRemoveDiag(data)
{
  if(data=="SUCCESS")
      document.location.href="myproject.php"

  else
  {
    swal({
        type: 'error',
        title: 'Un problème est survenue',
        html: data
      })
  }
}
