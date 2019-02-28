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
            background-image: url("{{ asset('img/wood_floor.jpg') }}");
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

<div id="button" class="container-fluid">
    <button id="exit" class="btn btn-danger">Exit layout builder</button>
    <button id="save" class="btn btn-primary">
        Save layout
    </button>
    <br><button id="addSquare" class="btn btn-success">
        Add square table
    </button>
    <br><button id="addRound" class="btn btn-success">
        Add round table
    </button>
</div>


<script>

    var stage;
    var layer;
    var rectX;
    var rectY;
    var counter;
    var deleteLayer;

    window.onload = function() {

        checkNum = function(num) {
            var aNums = [];
            layer.getChildren().each(function(group) {
                aNums.push(group.find('.text')[0].getText());
            });

            while(aNums.includes(num.toString())) {
                num++;
            }

            return num;
        }

        drawDeleteArea = function() {
            this.deleteLayer = new Konva.Layer();
            let deleteRect = new Konva.Rect({
                x: 0,
                y: this.stage.getHeight() - 100,
                width: this.stage.getWidth(),
                height:100,
                fillLinearGradientStartPoint: { x: 0, y: 0 },
                fillLinearGradientEndPoint: { x: 0, y: 150 },
                fillLinearGradientColorStops: [0, '#bc976b', 1, 'red'],
                id: 'delete',
            });
            let text = new Konva.Text({
                text: 'DELETE',
                fill: '#ffffff',
                fontSize: 40,
                x: (this.stage.getWidth() / 2) - 150,
                y: this.stage.getHeight() - 50,
                id: 'delete',
            });
            let group = new Konva.Group();
            group.add(deleteRect);
            group.add(text);

            this.deleteLayer.add(group);
            this.stage.add(this.deleteLayer);
            this.deleteLayer.moveToBottom();
        }

        removeDeleteArea = function(group) {
            let pos = this.stage.getPointerPosition();
            let shape = this.deleteLayer.getIntersection(pos);
            if (shape) {
                if (shape.getAttr('id') == 'delete') {
                    var tableId = group.find('.text')[0].getAttr('text');
                    group.destroy();
                    Vue.http.post('/api/table/delete', {table: tableId}).then(response => {
                    });
                    this.layer.draw();
                }
            }
            this.deleteLayer.destroyChildren();
            this.deleteLayer.draw();
        }

        renameTable = function(group) {
            console.log(group);
            let name = prompt('New name');
            let newName = checkNum(name);
            if (newName && !isNaN(newName) && name == newName && parseInt(name) > 0) {
                let text = group.find('.text')[0];
                var oldName = text.getAttr('text');
                text.setAttr('text', newName);
                Vue.http.post('/api/table/rename', {old: oldName, new: newName}).then(response => {
                });
                this.layer.draw();
            }
        }

        addDBTable = function(id) {
            Vue.http.post('/api/table/create', {table: id}).then(response => {
            });
        }

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

               this.layer = new Konva.Layer({
                   id: 'main',
               });
               this.rectX = this.stage.getWidth() / 2 - 50;
               this.rectY = this.stage.getHeight() / 2 - 25;

               this.stage.add(layer);
           } else {
               this.stage = Konva.Node.create(JSON.parse(layout.json), 'container');
               this.stage.setWidth(window.innerWidth);
               this.stage.setHeight(window.innerHeight);
               this.layer = this.stage.find('#main')[0];

               this.layer.getChildren().each(function (group) {
                   group.on('mouseover', function() {
                       document.body.style.cursor = 'pointer';
                   });
                   group.on('mouseout', function() {
                       document.body.style.cursor = 'default';
                   });
                   group.on('dragstart', function() {
                       drawDeleteArea();
                   });
                   group.on('dragend', function() {
                       removeDeleteArea(group);
                   });
                   group.on('dblclick', function() {
                       renameTable(group);
                   });
               });

               this.counter = this.layer.getChildren().length + 1;

               this.rectX = this.stage.getWidth() / 2 - 50;
               this.rectY = this.stage.getHeight() / 2 - 25;
           }
        }).bind(this);
    }

    document.getElementById('addSquare').addEventListener('click', function() {
        counter = checkNum(counter);
        let box = new Konva.Rect({
            x: rectX,
            y: rectY,
            width: 100,
            height: 50,
            fill: '#ffffff',
            stroke: '#5a3e2d',
            strokeWidth: 2,
            name: 'table',
        });

        let text = new Konva.Text({
            text: counter.toString(),
            fill: '#5a3e2d',
            fontSize: 25,
            x: rectX + 40,
            y: rectY + 15,
            name: 'text',
        });

        let group = new Konva.Group({
            draggable: true,
        });

        // add cursor styling
        group.on('mouseover', function() {
            document.body.style.cursor = 'pointer';
        });
        group.on('mouseout', function() {
            document.body.style.cursor = 'default';
        });
        group.on('dragstart', function() {
            drawDeleteArea();
        });
        group.on('dragend', function() {
            removeDeleteArea(group);
        });
        group.on('dblclick', function() {
            renameTable(group);
        });

        addDBTable(counter.toString());

        group.add(box);
        group.add(text);
        layer.add(group);
        layer.draw();

        counter++;
    }, false);

    document.getElementById('addRound').addEventListener('click', function() {
        counter = checkNum(counter);
        let circ = new Konva.Circle({
            x: rectX,
            y: rectY,
            radius: 35,
            fill: '#ffffff',
            stroke: '#5a3e2d',
            strokeWidth: 2,
            name: 'table',
        });

        let text = new Konva.Text({
            text: counter.toString(),
            fill: '#5a3e2d',
            fontSize: 25,
            x: rectX - 8,
            y: rectY - 8,
            name: 'text',
        });

        let group = new Konva.Group({
            draggable: true,
        });

        // add cursor styling
        group.on('mouseover', function() {
            document.body.style.cursor = 'pointer';
        });
        group.on('mouseout', function() {
            document.body.style.cursor = 'default';
        });
        group.on('dragstart', function() {
            drawDeleteArea();
        });
        group.on('dragend', function() {
            removeDeleteArea(group);
        });
        group.on('dblclick', function() {
            renameTable(group);
        });

        addDBTable(counter.toString());

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

        Vue.http.post('/api/table/save');
    }, false);

    document.getElementById('exit').addEventListener('click', function() {
        Vue.http.post('/api/table/nosave').then(response => {
            window.location.href = '/dashboard';
        });
    }, false);
</script>

</body>
</html>