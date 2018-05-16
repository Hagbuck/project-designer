var text_offset = 12;
var window_offset = 20;
var branch_size = 240;
var default_tag_color = '#F0FA0F';
var default_tag_text = 'New note';

var width = document.getElementById("container").offsetWidth;
var height = document.getElementById("container").offsetHeight;

var stage = new Konva.Stage({
    container: 'container',
    width: width,
    height: height
});

var layer = new Konva.Layer();
<<<<<<< HEAD
var centerX = stage.getWidth() / 2;
var centerY = stage.getHeight() / 2;
=======
var rectX = stage.getWidth() / 2 - 50;
var rectY = stage.getHeight() / 2 - 25;

var tag = new Konva.Group({
    draggable: true
});

var box = new Konva.Rect({
    x: rectX,
    y: rectY,
    width: 100,
    height: 50,
    fill: '#00D2FF',
    stroke: 'black',
    strokeWidth: 4
});
var box_text = new Konva.Text({
    x: box.position().x + 12,
    y: box.position().y + 12,
    fontFamily: 'Calibri',
    fontSize: 16,
    text: 'Salut',
    fill: 'black'
});

tag.add(box);
tag.add(box_text);
>>>>>>> front_design

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
var nb_branch = 6;
var angle = 2*Math.PI / nb_branch;
for(var i = 0; i < nb_branch; ++i){
    var branch = createBranch('Dev' + i, angle * i, branch_size, center, window_offset);
    layer.add(branch);
}

// A TAG
var tags_groups = new Konva.Group({});
for(var i = 0; i < 3; ++i){
    var tag = createTag(default_tag_text, default_tag_color, i, centerX, centerY, text_offset);

    changeTagPosition(tag, i*100, i*100, text_offset);
    stage.draw();

<<<<<<< HEAD
    tags_groups.add(tag);
}

layer.add(tags_groups);
=======
layer.add(text);
layer.add(center);
layer.add(branch);
layer.add(tag);
>>>>>>> front_design
stage.add(layer);
