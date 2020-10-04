<!DOCTYPE html>
<html>
<head>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

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
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="/dashboard" class="no-decoration">
                <div class="pos-header-exit text-center">
                    <h2>Exit POS Mode</h2>
                </div>
            </a>
        </div>
    </div>
</div>

<div id="container"></div>
<script>

    var stage;
    var floorLayer;
    var layer;
    var needSave = 0;

    window.onload = function() {

        this.needSave = 0;

        drawLayout = function(layout) {
            this.stage = Konva.Node.create(JSON.parse(layout.json), 'container');
            this.floorLayer = this.stage.find('#floor')[0];
            this.layer = this.stage.find('#main')[0];
            this.floorLayer.draw();
            this.layer.draw();

            let tables = this.layer.getChildren();
            tables.each(function(table) {
                table.setAttr('draggable', false);
                var tableNumber = table.getChildren()[1].getAttr('text');
                table.on('click', function() {
                    window.location.href = '/pos/' + tableNumber;
                });
                Vue.http.get('/api/table/' + tableNumber + '/status').then(response => {
                    let shape = table.find('.table')[0];
                    if (response.body.toString() == 'seated' && shape.getAttr('fill') != 'lightblue') {
                        needSave = 1;
                        shape.setAttr('fill', 'lightblue');
                        this.layer.draw();
                    } else if (response.body.toString() == 'empty' && shape.getAttr('fill') != 'white') {
                        needSave = 1;
                        shape.setAttr('fill', 'white');
                        this.layer.draw();
                    }
                }).then(function () {
                    if (needSave == 1) {
                        var layout = stage;
                        console.log(layout);
                        Vue.http.post('/settings/table/poslayout', {jsonLayout: layout}, {
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                    }
                });

            });

            let floors = this.floorLayer.getChildren();
            floors.each(function(floor) {
                floor.setAttr('draggable', false);
            });
        }

        Vue.http.get('/settings/table/poslayout').then(response => {
            var poslayout = response.body;
            if (poslayout == '') {
                Vue.http.get('/settings/table/layout').then(response => {
                    var layout = response.body;
                    if (layout == '') {
                        window.location.href = '/settings/table';
                    } else {
                        drawLayout(layout);
                    }
                })
            } else {
                drawLayout(poslayout);
            }

        }).bind(this);
    }
</script>

</body>
</html>