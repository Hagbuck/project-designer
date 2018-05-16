<!DOCTYPE html>
    <html>
    <head>
        <!-- <script src="https://cdn.rawgit.com/konvajs/konva/2.1.2/konva.min.js"></script> -->
        <script src="js/konvas.min.js"></script>
        <meta charset="utf-8">
        <title>Work window</title>
        <style>
            body {
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: #F0F0F0;
            }
        </style>
    </head>
    <body>
    <div id="container"></div>
    <script>
        var width = window.innerWidth;
        var height = window.innerHeight;

        var stage = new Konva.Stage({
            container: 'container',
            width: width,
            height: height
        });

        var layer = new Konva.Layer();
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

        var center = new Konva.Circle({
            x: stage.getWidth() / 2,
            y: stage.getHeight() / 2,
            radius: 3,
            fill: 'black',
            stroke: 'black',
            strokeWidth: 2
        })

        var branch = new Konva.Line({
          points: [center.position().x, center.position().y, center.position().x, 0+20],
          stroke: 'black',
          strokeWidth: 3,
          lineCap: 'round',
          lineJoin: 'round'
        });

        var text = new Konva.Text({
            x: 10,
            y: 10,
            fontFamily: 'Calibri',
            fontSize: 24,
            text: '',
            fill: 'black'
        });

        function writeMessage(message) {
            text.setText(message);
            console.log(message);
            layer.draw();
        }

        box.on('dragend', function() {
            // TODO : enregistrer pos dans DB
            writeMessage(box.position().x + ' : ' + box.position().y);
        });

        // add cursor styling
        tag.on('mouseover', function() {
            document.body.style.cursor = 'pointer';
        });
        tag.on('mouseout', function() {
            document.body.style.cursor = 'default';
        });

        layer.add(text);
        layer.add(center);
        layer.add(branch);
        layer.add(tag);
        stage.add(layer);
    </script>

    </body>
    </html>