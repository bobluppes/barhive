// $(function() {
//     Morris.Donut({
//         element: 'morris-donut-chart',
//         data: [{
//             label: "Download Sales",
//             value: 12
//         }, {
//             label: "In-Store Sales",
//             value: 30
//         }, {
//             label: "Mail-Order Sales",
//             value: 20
//         }],
//         resize: true
//
//     });
// });

var productGraph;

var donutVue = new Vue({
    el: '#morris-donut-chart',
    data: {
        products: {},
        url: '/api/products/sales',
    },

    methods: {
    },

    mounted() {
        this.$http.get(this.url).then(response => {
            let products = response.body;
            this.products = products;

            productGraph = new Morris.Donut({
                element: 'morris-donut-chart',
                data: this.products,
                resize: true,
            });
        });
    }
})