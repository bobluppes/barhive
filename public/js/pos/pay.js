window.onload = function() {
    document.getElementById('pay').addEventListener('click', function() {
        Vue.http.post('/api/bill/' + this.value + '/pay').then(response => {
            window.location.href = '/pos';
        })
    }, false);

    document.getElementById('deleteBill').addEventListener('click', function() {
        Vue.http.post('/api/bill/' + this.dataset.id + '/delete').then(function() {
            window.location.href = '/pos';
        });
    }, false);

    var deleteSale = document.getElementsByName('deleteSale');
    deleteSale.forEach(function(sale) {
        sale.addEventListener('click', function() {
            var id = this.dataset.id;
            Vue.http.post('/api/sale/' + this.dataset.id + '/delete').then(function() {
                window.location.reload();
            }).bind(this);
        });
    })
}