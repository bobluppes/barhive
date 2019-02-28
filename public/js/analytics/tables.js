var stage;
var layer;
var rectX;
var rectY;
var counter;
var deleteLayer;
var needSave = 0;

var tooltipLayer = new Konva.Layer();
var tooltip = new Konva.Text({
    text: "",
    fontFamily: "Calibri",
    fontSize: 20,
    padding: 5,
    textFill: "white",
    fill: "black",
    alpha: 0.75,
    visible: false
});
tooltipLayer.add(tooltip);

window.onload = function() {

    this.needSave = 0;

    drawLayout = function(layout) {
        this.stage = Konva.Node.create(JSON.parse(layout.json), 'container');
        this.stage.setWidth(window.innerWidth);
        this.stage.setHeight(window.innerHeight);
        this.layer = this.stage.find('#main')[0];
        stage.add(tooltipLayer);

        var sales = {};
        var waiting = this.layer.getChildren().length;
        this.layer.getChildren().each(function (group) {
            group.setAttr('draggable', false);
            let table = group.find('.text')[0].getText();
            Vue.http.get('/api/sales/table/' + table).then(response => {
                let tableSales = response.body;
                sales[table] = tableSales;
                waiting--;
                if (waiting == 0) {
                    let keysSorted = Object.keys(sales).sort(function(a,b){return sales[a]-sales[b]});
                    let maxTable = keysSorted[keysSorted.length - 1];
                    var max = sales[maxTable];
                    console.log(sales);
                    this.layer.getChildren().each(function (group) {
                        let table = group.find('.text')[0].getText();
                        let shape = group.find('.table')[0];
                        let tableSales = sales[table];
                        if (shape.getAttr('fill') != 'green' || shape.opacity() != ((tableSales / max) * 0.9 + 0.1)) {
                            needSave = 1;
                            shape.setAttr('fill', 'green');
                            shape.opacity((tableSales / max) * 0.9 + 0.1);
                            this.layer.draw();
                        }
                        group.on("mousemove", function(){
                            var mousePos = stage.getPointerPosition();
                            tooltip.position({
                                x : mousePos.x + 5,
                                y : mousePos.y + 5
                            });
                            tooltip.text(tableSales.toString());
                            tooltip.show();
                            tooltipLayer.batchDraw();
                        });
                        group.on("mouseout", function(){
                            tooltip.hide();
                            tooltipLayer.draw();
                        });
                    });
                }
            }).then(function () {
                if (needSave == 1) {
                    var layout = stage;
                    console.log(layout);
                    Vue.http.post('/settings/table/analyticslayout', {jsonLayout: layout}, {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                }
            });
        });

        this.counter = this.layer.getChildren().length + 1;

        this.rectX = this.stage.getWidth() / 2 - 50;
        this.rectY = this.stage.getHeight() / 2 - 25;
    }

    Vue.http.get('/settings/table/analyticslayout').then(response => {
        var layout = response.body;

        if (layout == '') {
            Vue.http.get('/settings/table/layout').then(response => {
                var layout = response.body;

                if (layout == '') {
                    window.location.href = '/settings/table';
                } else {
                    drawLayout(layout);
                }
            });
        } else {
            drawLayout(layout);
        }
    }).bind(this);
}