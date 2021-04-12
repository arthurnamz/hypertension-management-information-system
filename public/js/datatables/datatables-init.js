// $(document).ready(function() {
//         $('#myTable').DataTable();
//         $(document).ready(function() {
//             var table = $('#example').DataTable({
//                 "columnDefs": [{
//                     "visible": false,
//                     "targets": 2
//                 }],
//                 "order": [
//                     [2, 'asc']
//                 ],
//                 "displayLength": 25,
//                 "drawCallback": function(settings) {
//                     var api = this.api();
//                     var rows = api.rows({
//                         page: 'current'
//                     }).nodes();
//                     var last = null;
//                     api.column(2, {
//                         page: 'current'
//                     }).data().each(function(group, i) {
//                         if (last !== group) {
//                             $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
//                             last = group;
//                         }
//                     });
//                 }
//             });
//             // Order by the grouping
//             $('#example tbody').on('click', 'tr.group', function() {
//                 var currentOrder = table.order()[0];
//                 if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
//                     table.order([2, 'desc']).draw();
//                 } else {
//                     table.order([2, 'asc']).draw();
//                 }
//             });
//         });
//     });
//     $('#example23').DataTable({
//         dom: 'Bfrtip',
//         buttons: [
//             'copy', 'csv', 'excel', 'pdf', 'print'
//         ]
//     });

(function ($) {
    //    "use strict";


    /*  Data Table
    -------------*/




    $('#bootstrap-data-table').DataTable({
        lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
    });



    $('#bootstrap-data-table-export').DataTable({
        lengthMenu: [[5, 10, 20,25, 50, 75, 100, -1], [5, 10, 20, 25, 50, 75, 100, "All"]], 
        dom: 'lBfrtip',
        buttons: [
           {
                extend: 'copyHtml5',
                title: 'MUST EMPLOYEE LIST',
                filename: 'MUST Employee list',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            }, {
                extend: 'csvHtml5',
                title: 'MUST EMPLOYEE LIST',
                filename: 'MUST Employee list',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            }, {
                extend: 'excelHtml5',
                title: 'MUST EMPLOYEE LIST',
                filename: 'MUST Employee list',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            },  {
                extend: 'pdfHtml5',
                 title: 'MUST EMPLOYEE LIST',
                filename: 'MUST Employee list',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            }, {
                extend: 'print',
                title: 'MUST EMPLOYEE LIST',
                filename: 'MUST Employee list',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            }
        ]
         
    });
    
    $('#row-select').DataTable( {
            initComplete: function () {
                this.api().columns().every( function () {
                    var column = this;
                    var select = $('<select class="form-control"><option value=""></option></select>')
                        .appendTo( $(column.footer()).empty() )
                        .on( 'change', function () {
                            var val = $.fn.dataTable.util.escapeRegex(
                                $(this).val()
                            );
     
                            column
                                .search( val ? '^'+val+'$' : '', true, false )
                                .draw();
                        } );
     
                    column.data().unique().sort().each( function ( d, j ) {
                        select.append( '<option value="'+d+'">'+d+'</option>' )
                    } );
                } );
            }
        } );






})(jQuery);