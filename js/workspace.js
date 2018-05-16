var text_offset = 12;

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

// A TAG
var tag = createTag('Tag1', '#FF0000', centerX, centerY, text_offset);

// THE CENTER
var center = new Konva.Circle({
    x: stage.getWidth() / 2,
    y: stage.getHeight() / 2,
    radius: 3,
    fill: 'black',
    stroke: 'black',
    strokeWidth: 2
})

// ONE BRANCH
var branch = new Konva.Line({
  points: [center.position().x, center.position().y, center.position().x, 0+20],
  stroke: 'black',
  strokeWidth: 3,
  lineCap: 'round',
  lineJoin: 'round'
});

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


layer.add(center);
layer.add(branch);
layer.add(tag);
stage.add(layer);