<!DOCTYPE html>
<html>
<head>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <script src="https://unpkg.com/konva@2.4.2/konva.min.js"></script>
    <script src="/js/vue.min.js"></script>
    <script src="/js/vue-resource.min.js"></script>

    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BarHive</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            background-color: #F0F0F0;
        }
        #button {
            position: absolute;
            left: 10px;
            top: 0px;
        }
        button {
            margin-top: 10px;
            display: block;
        }
    </style>
</head>
<body>
<div id="container"></div>
<div id="button">
    <a href="/dashboard"><button id="exit" class="btn btn-danger">Exit layout builder</button></a>
    <button id="save" class="btn btn-primary">
        Save layout
    </button>
    <button id="addSquare" class="btn btn-outline btn-success">
        Add square table
    </button>
    <button id="addRound" class="btn btn-outline btn-success">
        Add round table
    </button>
</div>
<script>

    var stage;
    var layer;
    var rectX;
    var rectY;
    var counter;

    window.onload = function() {

        Vue.http.get('/settings/table/layout').then(response => {
           layout = response.body;

           if (layout.length == 0) {
               var width = window.innerWidth;
               var height = window.innerHeight;

               this.stage = new Konva.Stage({
                   container: 'container',
                   width: width,
                   height: height,
               });
               this.counter = 1;

               this.layer = new Konva.Layer();
               this.rectX = this.stage.getWidth() / 2 - 50;
               this.rectY = this.stage.getHeight() / 2 - 25;

               this.stage.add(layer);
           } else {
               this.stage = Konva.Node.create(JSON.parse(layout[0].json), 'container');
               this.layer = this.stage.getLayers()[0];

               this.counter = this.layer.getChildren().length + 1;

               this.rectX = this.stage.getWidth() / 2 - 50;
               this.rectY = this.stage.getHeight() / 2 - 25;
           }
        }).bind(this);
    }



    document.getElementById('addSquare').addEventListener('click', function() {
        let box = new Konva.Rect({
            x: rectX,
            y: rectY,
            width: 100,
            height: 50,
            fill: '#00D2FF',
            stroke: 'black',
            strokeWidth: 4,
        });

        let text = new Konva.Text({
            text: counter.toString(),
            fontSize: 25,
            x: rectX + 40,
            y: rectY + 15,
        });

        // add cursor styling
        box.on('mouseover', function() {
            document.body.style.cursor = 'pointer';
        });
        box.on('mouseout', function() {
            document.body.style.cursor = 'default';
        });

        let group = new Konva.Group({
            draggable: true,
        });
        group.add(box);
        group.add(text);
        layer.add(group);
        layer.draw();

        counter++;
    }, false);

    document.getElementById('addRound').addEventListener('click', function() {
        let circ = new Konva.Circle({
            x: rectX,
            y: rectY,
            radius: 35,
            fill: '#00D2FF',
            stroke: 'black',
            strokeWidth: 4,
        });

        let text = new Konva.Text({
            text: counter.toString(),
            fontSize: 25,
            x: rectX - 8,
            y: rectY - 8,
        });

        // add cursor styling
        circ.on('mouseover', function() {
            document.body.style.cursor = 'pointer';
        });
        circ.on('mouseout', function() {
            document.body.style.cursor = 'default';
        });

        let group = new Konva.Group({
            draggable: true,
        });
        group.add(circ);
        group.add(text);
        layer.add(group);
        layer.draw();

        counter++;
    }, false);

    document.getElementById('save').addEventListener('click', function() {
        var layout = stage.toJSON();

        Vue.http.post('/settings/table/layout', {jsonLayout: layout}, {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }, false);
</script>

</body>
</html>