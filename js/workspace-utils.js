// TODO : on click sur box
// THEN envoyer l'obejt a la function js qui remplit le formulaire.
// PUIS modification des database -> reload du shema

function fill_form_edit_tag(tag){
    var children = tag.getChildren();

    $('input#tag_text').val(children[1].getText());
    $('input#tag_color').val(children[0].getAttr('fill'));
    $('input#tag_id').val(tag.id);
}

function writeMessage(layer, text, message) {
    text.setText(message);
    layer.draw();
}

function changeTagPosition(tag, x, y, text_offset){
    tag.setPosition({x,y});
}

function createTag(text, color, tag_id, centerX, centerY, text_offset){
    var tag = new Konva.Group({
        draggable: true
    });
    var box = new Konva.Rect({
        x: centerX-100/2,
        y: centerY-50/2,
        width: 100,
        height: 50,
        fill: color,
        stroke: 'black',
        strokeWidth: 2,
    });
    var box_text = new Konva.Text({
        x: box.position().x + text_offset,
        y: box.position().y + text_offset,
        fontFamily: 'Calibri',
        fontSize: 16,
        text: text,
        fill: 'black'
    });

    tag.add(box);
    tag.add(box_text);

    tag.id = tag_id;

    tag.on('click', function(){
        fill_form_edit_tag(tag);
        stage.draw();
    });

    tag.on('dragend', function() {
        // TODO : enregistrer pos dans DB
        console.log(tag.id + ' | ' + tag.x() + ' : ' + tag.y());
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

function removeTag(){
    var id = $('input#tag_id').val();
    if(id != null && id != undefined && id != '')
    {
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
    var last_point_x = branch_size * Math.cos(angle) + center.position().x;
    var last_point_y = branch_size * Math.sin(angle) + center.position().y;

    var branch = new Konva.Group({
    });
    var line = new Konva.Line({
    points: [center.position().x, center.position().y, last_point_x, last_point_y],
        stroke: 'black',
        strokeWidth: 3,
        lineCap: 'round',
        lineJoin: 'round'
    });
    var branch_text = new Konva.Text({
        x: last_point_x,
        y: last_point_y,
        fontFamily: 'Calibri',
        fontSize: 16,
        text: text,
        fill: 'black'
    });

    branch.add(line);
    branch.add(branch_text);

    return branch;
}