$(document).ready(function() {
    $('#urun-listesi').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            }
        ],
    } );

    $('#tedarikci-listesi').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'excel', 'pdf'
        ],
        exportOptions: {
            columns: [ 0, 1, 2, 3, 4 ]
        }
    } );

} );
