// TODO : on click sur box
// THEN envoyer l'obejt a la function js qui remplit le formulaire.
// PUIS modification des database -> reload du shema

function fill_form_edit_tag(GroupKonvas){
    var children = GroupKonvas.getChildren();

    console.log('TITLE : ' + children[1].getText());
    console.log('COLOR : ' + children[0].getAttr('fill'));

    $('input#tag_text').val(children[1].getText());
    $('input#tag_color').val(children[0].getAttr('fill'));
}
