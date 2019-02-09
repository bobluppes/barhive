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
                salesGraph.setData(this.sales);
                salesGraph.redraw();
            }, 5000)
        },

        timeframeDay(e) {
            e.preventDefault();
            clearInterval(this.polling);
            $("#morris-area-chart").empty();
            $('#morris-area-chart-action')[0].innerHTML = 'Today <span class="caret"></span>';
            $('#morris-area-chart-title')[0].innerHTML = 'Todays sales';
            this.sales = null;
            this.url = '/api/sales/today';

            this.$http.get(this.url).then(response => {
                salesToday = response.body;
                this.sales = salesToday;

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
            });
        },
        timeframeMonth(e) {
            e.preventDefault();
            clearInterval(this.polling);
            $("#morris-area-chart").empty();
            $('#morris-area-chart-action')[0].innerHTML = 'This month <span class="caret"></span>';
            $('#morris-area-chart-title')[0].innerHTML = 'This months sales';
            this.sales = null;
            this.url = '/api/sales/month';

            this.$http.get(this.url).then(response => {
                salesToday = response.body;
                this.sales = salesToday;

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
            });
        },
        timeframeYear(e) {
            e.preventDefault();
            clearInterval(this.polling);
            $("#morris-area-chart").empty();
            $('#morris-area-chart-action')[0].innerHTML = 'This year <span class="caret"></span>';
            $('#morris-area-chart-title')[0].innerHTML = 'This years sales';
            this.sales = null;
            this.url = '/api/sales/year';

            this.$http.get(this.url).then(response => {
                salesToday = response.body;
                this.sales = salesToday;

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
            });
        }
    },

    beforeDestroy () {
        clearInterval(this.polling);
    },

    mounted() {
        this.$http.get(this.url).then(response => {
            salesToday = response.body;
            this.sales = salesToday;

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
        });
    }
})