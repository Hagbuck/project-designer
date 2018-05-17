
function display_projects(stringJSON)
{
  stringJSON = JSON.stringify(stringJSON);
  var dataProjet = JSON.parse(stringJSON);


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
      <p class="namePBlock" onclick="get_diagrams(\''+value['id']+'\',\''+value['name']+'\')">  '+value["name"]+' </p> \
      <p class="datePBlock"> <span> Créé le :</span>  '+value["date_crea"]+' </p> \
      <p class="descPBlock"> '+value["description"]+' </p> \
      <p class="adminBlock"> <span>Admin</span> : '+stringAdmin+' </p> \
    </div> \
    <hr style="margin-bottom:10px">';
    $('#tabProjet').append(stringProjet);
});
$('#tabProjet').append('<div id="addProjectButton" onclick="create_project()"> <span>+</span> </div><hr>');
}


function most_recent_project(stringJSON)
{

  stringJSON = JSON.stringify(stringJSON);
  var dataProjet = JSON.parse(stringJSON);

  var id_max = -1
  var date_max = new Date(0,0,0);
  var name_max = null;

  $.each(dataProjet, function(index, value) {
    var splitdate = value["date_crea"].split("/");
    var date = new Date(splitdate[2],splitdate[1],splitdate[0]);
    if(date >date_max)
    {
      id_max = value["id"]
      date_max = date
      name_max =  value["name"]
    }
});
  return [id_max,name_max];

}


function display_diagrames(stringJSON,idProject,nameProjet)
{
  $(".diagram").remove();
  $("#mydiagrams").children("hr").remove();
  $('#mydiagrams').append("<hr>");

  var alldiag = document.getElementById("mydiagrams")
  alldiag.getElementsByTagName("hr")


  stringJSON = JSON.stringify(stringJSON);
  var dataDiagram = JSON.parse(stringJSON);


  $.each(dataDiagram, function(index, value) {

    if(value["projectid"] == idProject)
    {
      var stringContributeur = "";
      for(var i=0;i<value["contributors"].length;i++)
      {
        stringContributeur += value["contributors"][i]
        if(i+1 !=value["contributors"].length)
          stringContributeur += ", "
        else
          stringContributeur += "."
      }

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
      $('#mydiagrams').append(stringDiagram);
      $('#nameProject').html(nameProjet);
    }
});
$('#mydiagrams').append('<div id="addDiagramButton" onclick="create_diagram()"> <span>+</span> </div><hr style="margin-bottom:10px">');
}


async function tenta_crea(name,desc)
{
  var user = 1

  if(name != "" && name !=undefined && desc != "" && desc !=undefined)
  {
    $.ajax({
       url : "traitement.php",
       type : 'POST',
       data : 'fonction=createProject&user_id='+user+"nom_projet="+name+"&description_projet="+desc,
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
