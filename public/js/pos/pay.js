window.onload = function() {
    document.getElementById('pay').addEventListener('click', function() {
        Vue.http.post('/api/bill/' + this.value + '/pay').then(response => {
            window.location.href = '/pos';
        })
    }, false);
}