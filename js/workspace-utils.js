// TODO : on click sur box
// THEN envoyer l'obejt a la function js qui remplit le formulaire.
// PUIS modification des database -> reload du shema

function fill_form_edit_tag(tag){
    var children = tag.getChildren();

    $('input#tag_text').val(children[1].getText());
    $('input#tag_color').val(children[0].getAttr('fill'));
}

function writeMessage(layer, text, message) {
    text.setText(message);
    layer.draw();
}

function changeTagPosition(tag, x, y, text_offset){
    tag.setPosition({x,y});
}

function createTag(text, color, centerX, centerY, text_offset){
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
        strokeWidth: 4
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
    return tag;
}