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
var nb_branch = 6;
var angle = 2*Math.PI / nb_branch;
for(var i = 0; i < nb_branch; ++i){
    var branch = createBranch('Dev' + i, angle * i, branch_size, center, window_offset);
    layer.add(branch);
}

// A TAG
var tags_groups = new Konva.Group({});
for(var i = 0; i < 3; ++i){
    var tag = createTag('Tag'+i, '#F0FA0F', i, centerX, centerY, text_offset);

    changeTagPosition(tag, i*100, i*100, text_offset);
    stage.draw();

    

    tags_groups.add(tag);
}

layer.add(tags_groups);
stage.add(layer);