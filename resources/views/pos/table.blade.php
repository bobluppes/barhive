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
    var layer;

    window.onload = function() {

        Vue.http.get('/settings/table/layout').then(response => {
            layout = response.body;

            if (layout.length == 0) {

                window.location.href = '/dashboard';

            } else {

                this.stage = Konva.Node.create(JSON.parse(layout[0].json), 'container');
                this.layer = this.stage.find('#main')[0];

                let tables = this.layer.getChildren();
                tables.each(function(table) {
                    table.setAttr('draggable', false);
                    table.on('click', function() {
                        let tableNumber = table.getChildren()[1].getAttr('text');
                        window.location.href = '/pos/' + tableNumber;
                    })
                })
            }
        }).bind(this);
    }
</script>

</body>
</html>