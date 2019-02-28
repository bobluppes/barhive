$('div.alert').parent().fadeIn(450);
$('div.alert').not('.alert-important').delay(4000).fadeOut(350);

window.onload = function() {
    undoSale = function(saleId) {
        Vue.http.post('/api/sale/' + saleId + '/delete').then(function() {
            alert('Sale undone');
        })
    }
}