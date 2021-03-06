/******************************************************************************/
/*************** [POLYTECH] Web Project - Project Designer  *******************/
/************************** Année 2017-2018 ***********************************/
/******* Detcheberry Valentin - Vuillemin Anthony - Corentin TROADEC **********/
/******************************************************************************/

/**
* @file ~ workspace-utils.js
* @descritpion ~ Scripts/Fonctions appelés lors de la modification d'un diagramme.
*/


// TODO : on click sur box
// THEN envoyer l'obejt a la function js qui remplit le formulaire.
// PUIS modification des database -> reload du shema

var max_tag_text_length = 11;

function subText(text){
    new_text = text
    if(text.length > max_tag_text_length){
        new_text = text.substring(0, max_tag_text_length);
        if(text.length > 2*max_tag_text_length)
            new_text += '\n' + text.substring(max_tag_text_length, 2*max_tag_text_length);
    }
    return new_text;
}

function fill_form_edit_tag(tag){
    var children = tag.getChildren();

    resetAllTagBorder();

    children[0].stroke('green');

    $('input#tag_text').val(tag.full_text);
    $('input#tag_color').val(children[0].getAttr('fill'));
    $('input#tag_hexa').val(children[0].getAttr('fill'));
    $('span#tag_id').html(tag.id);
}

function resetAllTagBorder(){
    var children = tags_groups.getChildren();

    for(var i = 0; i < children.length; ++i){
        children[i].getChildren()[0].stroke('black');
    }
}

function writeMessage(layer, text, message) {
    text.setText(message);
    layer.draw();
}

function removeBranches(){
    if(branches_group != null && branches_group != undefined){
        var children = branches_group.getChildren();
        var tour = children.length;
        for(var i = tour-1; i >= 0; --i){
            /*console.log('remove branche' + children[i].getChildren()[1].getAttr('text'));*/
            children[i].remove();
            stage.draw();
        }
    }
}

function createBranches(nb){
    var nb_branch = nb;
    var angle = 2*Math.PI / nb_branch;
    for(var i = 0; i < nb_branch; ++i){
        var branch = createBranch('Dev' + i, angle * i, branch_size, center, window_offset);
        branches_group.add(branch);
    }
}

function changeTagPosition(tag, x, y){
    tag.setPosition({x,y});
}

function createTag(text, color, tag_id, centerX, centerY, text_offset){
    var tag = new Konva.Group({
        draggable: true
    });

    // Custom attributes;
    tag.id = tag_id;
    tag.full_text = text;

    var box = new Konva.Rect({
        x:              centerX-100/2,
        y:              centerY-50/2,
        width:          100,
        height:         50,
        fill:           color,
        stroke:         'black',
        strokeWidth:    2,
    });

    sub_text = subText(text);

    var box_text = new Konva.Text({
        x:          box.position().x,
        y:          box.position().y,
        width:      box.width,
        height:     box.height,
        padding:    text_offset,
        fontFamily: 'Courrier',
        fontSize:   16,
        text:       sub_text,
        fill:       'black'
        //align:      'center'
    });

    tag.add(box);
    tag.add(box_text);

    tag.on('click', function(){
        fill_form_edit_tag(tag);
        /*updateTag(tag.id, 'CLICKED', 0, 0, 'red');*/
        stage.draw();
    });

    tag.on('dragend', function() {
        // TODO : enregistrer pos dans DB
        fill_form_edit_tag(tag);
        updateTag(1);
        console.log(tag.id + ' | ' + tag.x() + ' : ' + tag.y());
    });

    tag.on('dragstart', function(){
        fill_form_edit_tag(tag);
    });

    // add cursor styling
    tag.on('mouseover', function() {
        document.body.style.cursor = 'pointer';
    });
    tag.on('mouseout', function() {
        document.body.style.cursor = 'default';
    });

    return tag;
}

function remove_tag(){
    var id = $('#tag_id').html();
    if(id != null && id != undefined && id != '' && id != 'none')
    {
        //id = id.substring(2); // On enlève le
        id = parseInt(id);
        var children = tags_groups.getChildren();
        for(var i = 0; i < children.length; ++i){
            if(children[i].id == id){
                children[i].remove();
                stage.draw();
            }
        }
    }
}

function createBranch(text, angle, branch_size, center, window_offset){
    /* Calcul des coordonnée d'un point
    ** x = d*cos(alpha) + Ox
    ** y = d*cos(alpha) + Oy
    */
    angle -= Math.PI/2; // Pour afficher la première branche verticalement
    var last_point_x = branch_size * Math.cos(angle) + center.position().x;
    var last_point_y = branch_size * Math.sin(angle) + center.position().y;

    var branch = new Konva.Group({
    });

    var line = new Konva.Line({
    points: [center.position().x, center.position().y, last_point_x, last_point_y],
        stroke:         'black',
        strokeWidth:    3,
        lineCap:        'round',
        lineJoin:       'round'
    });

    var branch_text = new Konva.Text({
        x:          last_point_x,
        y:          last_point_y,
        fontFamily: 'Calibri',
        fontSize:   22,
        text:       text,
        fill:       'black'
    });

    branch.add(line);
    branch.add(branch_text);

    return branch;
}
