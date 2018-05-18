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


async function delBranch(diagramme_id)
{
  const {value: name} = await swal({
    title: 'Suppresion d\'un branche',
    type:"warning",
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
