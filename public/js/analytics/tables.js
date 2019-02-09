var stage;
var layer;
var rectX;
var rectY;
var counter;
var deleteLayer;

window.onload = function() {

    Vue.http.get('/settings/table/layout').then(response => {
        layout = response.body;

        if (layout.length == 0) {
            window.location.href = '/settings/table';
        } else {
            this.stage = Konva.Node.create(JSON.parse(layout[0].json), 'container');
            this.stage.setWidth(window.innerWidth);
            this.stage.setHeight(window.innerHeight);
            this.layer = this.stage.find('#main')[0];

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
                           shape.setAttr('fill', 'green');
                           shape.opacity((tableSales / max) * 0.9 + 0.1);
                           this.layer.draw();
                       });
                   }
                });
            });

            this.counter = this.layer.getChildren().length + 1;

            this.rectX = this.stage.getWidth() / 2 - 50;
            this.rectY = this.stage.getHeight() / 2 - 25;
        }
    }).bind(this);
}