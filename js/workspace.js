/******************************************************************************/
/*************** [POLYTECH] Web Project - Project Designer  *******************/
/************************** Année 2017-2018 ***********************************/
/******* Detcheberry Valentin - Vuillemin Anthony - Corentin TROADEC **********/
/******************************************************************************/

/**
* @file ~ workspace.js
* @descritpion ~ Création du workspace.
*/

  //DEFAULT PROPRIETIES
  var text_offset = 12;
  var window_offset = 20;
  var branch_size = 275;
  var default_tag_color = '#F0FA0F';
  var default_tag_text = 'New note';

  //REQUIREMENT
  var width = document.getElementById("container").offsetWidth;
  var height = document.getElementById( "container").offsetHeight;

  //MAIN KONVA
  var stage = new Konva.Stage({
      container: 'container',
      width: width,
      height: height
  });

  // ??????
  var layer = new Konva.Layer();
  var centerX = stage.getWidth() / 2;
  var centerY = stage.getHeight() / 2;

  // THE CENTER
  var center = new Konva.Circle({
      x: stage.getWidth() / 2,
      y: stage.getHeight() / 2,
      radius: 3,
      fill: 'black',
      stroke: 'black',
      strokeWidth: 2
  })
  layer.add(center);
  var branches_group = new Konva.Group({});
  var tags_groups = new Konva.Group({});


function display_branch(diagramme_id, callback)
{
  $.ajax({
     url : "traitement.php",
     type : 'POST',
     data : 'fonction=getBranch&diagramme_id='+diagramme_id,
     dataType : "json",
     success  : function(data){
       var n = 1
       var nb_branch = 0

       $.each(data, function(index, value){nb_branch++})

       var angle = 2*Math.PI / nb_branch

       if(data['#0'] != null)
       {
         $.each(data, function(index, value) {

            var branch = createBranch(value["nom_branche"], angle * n, branch_size, center, window_offset);
            n++
            stage.draw();
            branches_group.add(branch);
          })
       }
       layer.add(branches_group);
       stage.add(layer);
       stage.draw();
       callback();
      }
       ,
     error : function(resultat, statut, erreur){console.log("[ERROR] -> Fail to display_branch()");console.log(erreur);callback();}
    });
}

function display_tags(diagramme_id)
{

  $.ajax({
     url : "traitement.php",
     type : 'POST',
     data : 'fonction=getTags&diagramme_id='+diagramme_id,
     dataType : "json",
     success  : function(data){

       if(data['#0'] != null)
       {
         $.each(data, function(index, value) {

           var tag = createTag(value["texte_tag"], value["couleur_tag"], parseInt(value["id_tag"]), centerX, centerY, text_offset);
           changeTagPosition(tag, parseInt(value['pos_x_tag']), parseInt(value['pos_y_tag']));
            tags_groups.add(tag);

          })
       }
        stage.draw();
        layer.add(tags_groups);
        stage.add(layer);
        stage.draw();
      }
       ,
     error : function(resultat, statut, erreur){console.log("[ERROR] -> Fail to display_tag()");console.log(erreur)}
    });
}

function newTag(diagramme_id){
    $.ajax({
     url : "traitement.php",
     type : 'POST',
     data : 'fonction=createTag&id_diagramme='+diagramme_id+'&texte_tag='+default_tag_text+'&pos_x_tag='+(centerX-100/2)+'&pos_y_tag='+(centerY-50/2)+'&couleur_tag='+default_tag_color,
     dataType : "json",
     success  : function(data){
        //var tag = createTagBis(data["texte_tag"], data["couleur_tag"], data["id_tag"], data["pos_x_tag"], data["pos_y_tag"], text_offset)
         var tag = createTag(data["texte_tag"], data["couleur_tag"], parseInt(data["id_tag"]), centerX, centerY, text_offset);
         //changeTagPosition(tag, parseInt(data["pos_x_tag"], data["pos_y_tag"]));
        tags_groups.add(tag);
        stage.draw();
      }
       ,
     error : function(resultat, statut, erreur){console.log("[ERROR] -> Fail to create_new_tag()");console.log(erreur)}
   });
}

function updateTag(diagramme_id){
    var id = $('#tag_id').html();
    if(id != null && id != undefined && id != '' && id != 'none')
    {
        //id = id.substring(2); // On enlève le #
        id = parseInt(id);
        var children = tags_groups.getChildren();
        for(var j = 0; j < children.length; ++j){
            if(children[j].id == id){
                var tag_child = children[j].getChildren();
                 $.ajax({
                     url : "traitement.php",
                     type : 'POST',
                     data : 'fonction=updateTag&tag_id='+id+'&id_diagramme='+diagramme_id+'&texte_tag='+$('#tag_text').val()+'&pos_x_tag='+children[j].x()+'&pos_y_tag='+children[j].y()+'&couleur_tag='+$('#tag_hexa').val(),
                     dataType : "json",
                     success  : function(data){
                        //updateTag(id, data['texte_tag'], data['pos_x_tag'],data['pos_y_tag'],data['couleur_tag']);
                        var children = tags_groups.getChildren();
                        for(var j = 0; j < children.length; ++j){
                            if(children[j].id == id){
                                var tag_child = children[j].getChildren();
                                tag_child[0].fill(data['couleur_tag']);
                                tag_child[1].setText(subText(data['texte_tag']));
                                tag_child[1].full_text = data['texte_tag'];
                                changeTagPosition(children[j], parseInt(data['pos_x_tag']), parseInt(data['pos_y_tag']));
                                stage.draw();
                            }
                        }
                      }
                       ,
                     error : function(resultat, statut, erreur){console.log("[ERROR] -> Fail to update_tag()");console.log(erreur)}
                });
            }
        }
    }
}

/*function updateAllTags(diagramme_id){
    console.log('full update');
    $.ajax({
     url : "traitement.php",
     type : 'POST',
     data : 'fonction=getTags&diagramme_id='+diagramme_id,
     dataType : "json",
     success  : function(data){

       if(data['#0'] != null)
       {
         $.each(data, function(index, value) {
            console.log('Tag to update : ' + value['id_tag']);
           var children = tags_groups.getChildren();
           var tag_placed = false;
            for(var j = 0; j < children.length; ++j){
                if(children[j].id == value['id_tag']){
                    console.log('> ' + value['id_tag'] + ' update ' + children[j].id);
                    var tag_child = children[j].getChildren();
                    tag_child[0].fill(value['couleur_tag']);
                    tag_child[1].setText(value['texte_tag']);
                    changeTagPosition(children[j], parseInt(value['pos_x_tag']), parseInt(value['pos_y_tag']));
                    stage.draw();
                    tag_placed = true;
                }
            }
            if(tag_placed == false){ // On en créer un nouveau
                console.log('> ' + value['id_tag'] + ' created');
                var tag = createTag(value["texte_tag"], value["couleur_tag"], parseInt(value["id_tag"]), centerX, centerY, text_offset);
                 changeTagPosition(tag, parseInt(value["pos_x_tag"], value["pos_y_tag"]));
                tags_groups.add(tag);
                stage.draw();
            }
          })
       }
        stage.draw();
      }
       ,
     error : function(resultat, statut, erreur){console.log("[ERROR] -> Fail to update_all_tags()");console.log(erreur)}
    });
}*/

function removeTag(){
    var id = $('#tag_id').html();
    if(id != null && id != undefined && id != '' && id != 'none')
    {
        //id = id.substring(2); // On enlève le ' #'
        id = parseInt(id);
        console.log('id to remove : ' + id);
        var children = tags_groups.getChildren();
        for(var j = 0; j < children.length; ++j){
            if(children[j].id == id){
                 $.ajax({
                     url : "traitement.php",
                     type : 'POST',
                     data : 'fonction=removeTag&tag_id='+id,
                     dataType : "html",
                     success  : function(data){
                        //updateTag(id, data['texte_tag'], data['pos_x_tag'],data['pos_y_tag'],data['couleur_tag']);
                        remove_tag();
                        }
                       ,
                     error : function(resultat, statut, erreur){console.log("[ERROR] -> Fail to remove_tag()");console.log(erreur)}
                });
            }
        }
    }
}

async function newBranch(diagramme_id)
{
  const {value: name} = await swal({
    title: 'Ajouter une branche',
    confirmButtonColor: 'orange',
    html: '<input id="branchName" class="swal2-input" placeholder="Nom Branche">',
    preConfirm: (name) => tenta_crea_branch($(branchName).val(),diagramme_id)
  })
}

async function tenta_crea_branch(name,diagramme_id)
{
  if(name != "" && name !=undefined)
  {
    $.ajax({
       url : "traitement.php",
       type : 'POST',
       data : 'fonction=createBranch&digramme_id='+diagramme_id+"&nom_branche="+name,
       success : function(code_html, statut){
         if(code_html == "DONE")
           swal({type: 'success',title: 'La branche a bien été créé. Veuillez actualiser.',timer:3000})

        else
         swal({type: 'error', title: 'Un problème est survenue.',html:code_html,timer:10000});
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


async function delBranch(diagramme_id)
{
  const {value: name} = await swal({
    title: 'Suppresion d\'un branche',
    type:"warning",
    confirmButtonColor: 'orange',
    html: '<input id="branchName" class="swal2-input" placeholder="Nom Branche">',
    preConfirm: (name) => tenta_del_branch($(branchName).val(),diagramme_id)
  })
}

async function tenta_del_branch(name,diagramme_id)
{
  if(name != "" && name !=undefined)
  {
    $.ajax({
       url : "traitement.php",
       type : 'POST',
       data : 'fonction=delBranch&digramme_id='+diagramme_id+"&nom_branche="+name,
       success : function(code_html, statut){
         if(code_html == "DONE")
           swal({type: 'success',title: 'La branche a bien été supprimée. Veuillez actualiser.',timer:3000})

        else
         swal({type: 'error', title: 'Un problème est survenue.',html:code_html,timer:50000});
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

function invalid_access()
{
  swal({
      title: 'Accés Interdit',
      text: "Cette ressource n'est pas accessible de la sorte.",
      confirmButtonColor: 'orange',
      type: 'error',
      confirmButtonText: 'Sortir'
    }).then((result) => {  if (result.value) {document.location.href="myproject.php";}})
}

function valid_access(projet,diag)
{
  header_diagramme(diag);
  header_project(projet);
  display_branch(diag, function(){
    display_tags(diag); 
  });

  $('#new_tag').attr("onclick","newTag("+diag+")")
  $('#new_branch').attr("onclick","newBranch("+diag+")")
  $('#del_branch').attr("onclick","delBranch("+diag+")")

}

function header_diagramme(id)
{
  $.ajax({
     url : "traitement.php",
     type : 'POST',
     data : 'fonction=getNameDiagramById&digramme_id='+id,
     success : function(code_html, statut){$('#diagNameHeader').html(code_html)},
     error : function(resultat, statut, erreur){swal({type: 'error',title: 'Un problème est survenue.',html:erreur})}
    });
}

function header_project(id)
{
  $.ajax({
     url : "traitement.php",
     type : 'POST',
     data : 'fonction=getNameProjectById&projet_id='+id,
     success : function(code_html, statut){$('#projetNameHeader').html(code_html)},
     error : function(resultat, statut, erreur){swal({type: 'error',title: 'Un problème est survenue.',html:erreur})}
    });
}
