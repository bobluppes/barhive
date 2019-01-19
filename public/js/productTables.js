var productTable = [];

$(document).ready(function() {
    $('.table-striped').DataTable({
        responsive: true,
    });

    $('a[data-toggle="collapse"]').click(function (e) {
        setTimeout(reCalc, 200);
    } );

    reCalc = function() {
        console.log($.fn.dataTable.tables());
        $.fn.dataTable.tables( { api: true } ).columns.adjust();
    }


    var counter = 0;

    addTableRow = function() {
        productTable.row.add([
            '<input type="text" id="input-sName' + counter + '">',
            '<input type="text" id="input-fPrice"' + counter + '>',
            '<input type="text" id="input-iInventory"' + counter + '>',
            '<input type="text" id="input-iMinimumInventory"' + counter + '>',
            '',
        ]).draw(false);
        $('#saveButton')[0].style.display = 'block';

        counter++;
    }

    saveRow = function(count) {
        var data = productTable.$('input');
        console.log(data);
    }


});