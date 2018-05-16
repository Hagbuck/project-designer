var text_offset = 12;
var window_offset = 20;
var branch_size = 240;

var width = document.getElementById("container").offsetWidth;
var height = document.getElementById("container").offsetHeight;

var stage = new Konva.Stage({
    container: 'container',
    width: width,
    height: height
});

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

// BRANCHS
var nb_branch = 4;
var angle = 2*Math.PI / nb_branch;
for(var i = 0; i < nb_branch; ++i){
    var branch = createBranch('Dev' + i, angle * i, branch_size, center, window_offset);
    layer.add(branch);
}

// A TAG
var tag = createTag('Tag1', '#FF0000', centerX, centerY, text_offset);
layer.add(tag);

tag.on('dragend', function() {
    // TODO : enregistrer pos dans DB
    console.log(tag.x() + ' : ' + tag.y());
});

tag.on('click', function(){
    fill_form_edit_tag(tag);
    /*changeTagPosition(tag, 0, 0, text_offset);*/
    stage.draw();
});

// add cursor styling
tag.on('mouseover', function() {
    document.body.style.cursor = 'pointer';
});
tag.on('mouseout', function() {
    document.body.style.cursor = 'default';
});

stage.add(layer);