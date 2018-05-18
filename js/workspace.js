  //DEFAULT PROPRIETIES
  var text_offset = 12;
  var window_offset = 20;
  var branch_size = 240;
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


function display_branch(diagramme_id)
{

  $.ajax({
     url : "traitement.php",
     type : 'POST',
     data : 'fonction=getBranch&diagramme_id='+diagramme_id,
     dataType : "json",
     success  : function(data){
       var n = 1
       var nb_branch =0

       $.each(data, function(index, value){nb_branch++})

       var angle = 2*Math.PI / nb_branch
       console.log(nb_branch)

       $.each(data, function(index, value) {

          var branch = createBranch(value["nom_branche"], angle * n, branch_size, center, window_offset);
          n++
          stage.draw();
          branches_group.add(branch);
        })

        layer.add(branches_group);
        stage.add(layer);
        stage.draw();

      }
       ,
     error : function(resultat, statut, erreur){console.log("[ERROR] -> Fail to display_branch()");console.log(erreur)}
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

       $.each(data, function(index, value) {

         //var tag = createTagBis(value["texte_tag"], value["couleur_tag"], value["id_tag"], value["pos_x_tag"], value["pos_y_tag"], text_offset)
         var tag = createTag(value["texte_tag"], value["couleur_tag"], value["id_tag"], centerX, centerY, text_offset);
         changeTagPosition(tag, parseInt(value['pos_x_tag']), parseInt(value['pos_y_tag']));
          tags_groups.add(tag);

        })
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
     data : 'fonction=createTag&diagramme_id='+diagramme_id+'&text_tag='+default_tag_text+'&pos_x_tag='+(centerX-100/2)+'&pos_y_tag='+(centerY-50/2)+'&couleur_tag='+default_tag_color,
     dataType : "json",
     success  : function(data){
        console.log(data);
        var tag = createTagBis(data["texte_tag"], data["couleur_tag"], data["id_tag"], data["pos_x_tag"], data["pos_y_tag"], text_offset)
         //var tag = createTag(value["texte_tag"], value["couleur_tag"], value["id_tag"], centerX, centerY, text_offset)
        stage.draw();
        tags_groups.add(tag);

        layer.add(tags_groups);
        stage.add(layer);
        stage.draw();
      }
       ,
     error : function(resultat, statut, erreur){console.log("[ERROR] -> Fail to create_new_tag()");console.log(erreur)}
   });
}

<<<<<<< HEAD
async function newBranch(diagramme_id)
{
  const {value: name} = await swal({
    title: 'Ajouter une branche',
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

=======
function updateTag(diagramme_id){
    var id = $('#tag_id').html();
    if(id != null && id != undefined && id != '' && id != 'none')
    {
        id = id.substring(2,id.length-1); // On enlève le #
        var children = tags_groups.getChildren();
        console.log('nb note' + children.length);
        for(var j = 0; j < children.length; ++j){
            if(children[j].id == id){
                var tag_child = children[j].getChildren();
                 $.ajax({
                     url : "traitement.php",
                     type : 'POST',
                     data : 'fonction=updateTag&tag_id='+id+'&id_diagramme='+diagramme_id+'&texte_tag='+tag_child[1].text()+'&pos_x_tag='+children[j].x()+'&pos_y_tag='+children[j].y()+'&couleur_tag='+tag_child[0].fill(),
                     dataType : "json",
                     success  : function(data){
                        updateTag(id, data['texte_tag'], data['pos_x_tag'],data['pos_y_tag'],data['couleur_tag']);
                        stage.draw();
                        console.log(id + ' updated');
                      }
                       ,
                     error : function(resultat, statut, erreur){console.log("[ERROR] -> Fail to update_tag()");console.log(erreur)}
                });
            }
        }
    }
}

function removeTag(){

}
>>>>>>> b44bb884afe09ed731f74262342aada8c74650af


//getBranch
//getTag

/*
// BRANCHS

createBranches(12);
layer.add(branches_group);

// A TAG
var tags_groups = new Konva.Group({});
for(var i = 0; i < 3; ++i){
    var tag = createTag(default_tag_text, default_tag_color, i, centerX, centerY, text_offset);

    changeTagPosition(tag, i*100, i*100, text_offset);
    stage.draw();

    tags_groups.add(tag);
}

layer.add(tags_groups);
stage.add(layer);
*/
