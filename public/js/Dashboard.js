var salesGraph;

var areaVue = new Vue({
    el: '#morris-area-chart',
    data: {
        sales: [],
        url: '/api/sales/today',
        polling: null,
    },

    methods: {
        pollData() {
            this.polling = setInterval(() => {
                this.$http.get(this.url).then(response => {
                    salesToday = response.body;
                    this.sales = salesToday;
                });
                console.log(this.sales);

                salesGraph.setData(this.sales);
                salesGraph.redraw();

                console.log(this.url);
            }, 10000)
        },

        timeframeDay(e) {
            e.preventDefault();
            this.sales = [];
            salesGraph.setData(this.sales);
            salesGraph.redraw();
            this.url = '/api/sales/today';
        },
        timeframeMonth(e) {
            e.preventDefault();
            this.sales = [];
            salesGraph.setData(this.sales);
            salesGraph.redraw();
            this.url = '/api/sales/month';
        },
        timeframeAlltime(e) {
            e.preventDefault();
            clearInterval(this.polling);
            this.sales = null;
            salesGraph.setData(this.sales);
            salesGraph.redraw();
            this.url = '/api/sales/all';
            this.pollData();
        }
    },

    beforeDestroy () {
        clearInterval(this.polling);
    },

    mounted() {
        this.$http.get(this.url).then(response => {
            salesToday = response.body;
            this.sales = salesToday;
        });

        salesGraph = new Morris.Area({
            element: 'morris-area-chart',
            data: this.sales,
            xkey: 'time',
            ykeys: ['revenue'],
            labels: ['revenue'],
            pointSize: 2,
            hideHover: 'auto',
            resize: true
        });

        this.pollData();
    }
})