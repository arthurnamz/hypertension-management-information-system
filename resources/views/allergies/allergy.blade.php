
@extends('layouts.home', ['activePage' => 'allergy'])

@section('content')
               <link href="{{ asset('css/styleee.css')}}" rel="stylesheet">

            <div class="container-fluid">
            	<div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Allergies</h4>
                    </div>
                     @if(Auth::user()->role != 'patient')
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="{{ route('add_allergy')}}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Allergy</a>
                    </div>
                    @endif
                </div>
                <div class="row">
                    
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
               
                                <div class="table-responsive">
                                    <table id="bootstrap-data-table-export3" class="display nowrap table table-striped table-bordered">
                                        <thead>
                                    @if(Auth::user()->role == 'patient')
                                        <tr>
                                        <th>No.</th>                           
                                        <th>Allergy Name</th>
                                        <th>Test Date</th>
                                        <th>Tested By</th>                                   
                                        </tr>
                                        @else
                                        <tr>
                                        <th>No.</th>
										<th>Patient Name</th>
										<th>Gender</th>
										<th>Phone Number</th>
										<th>Email</th>
                                        <th>Number of Allergies</th>
                                        <th>Action</th>
                                        </tr>
                                         @endif
                                        </thead>
                                        <tbody>
                                        @foreach($Allergies as $allergy)
                                         @if(Auth::user()->role == 'patient')
                                        <tr>
                                            <td>{{$loop -> iteration }}</td>  
                                            <td>{{$allergy->name}}</td>
                                            <td>{{$allergy->tested_date}}</td>
                                            <td>{{$allergy->efname}} {{$allergy->elname}}</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td>{{$loop -> iteration }}</td>                 
                                            <td>{{$allergy->pfname}} {{$allergy->plname}}</td>
                                            <td>{{$allergy->pgender}}</td>
                                            <td>{{$allergy->pnumber}}</td>
                                            <td>{{$allergy->pemail}}</td>
                                            <td>{{$allergy->count}}</td>
                                            <td>
                                                
                                                    <a href="{{ route('view_allergy', ['id' => $allergy->id] ) }}" class="btn btn-sm btn-success btn-round">View</a> 
                                                    
                                            </td>
                                        </tr>
                                        @endif
                                          @endforeach
                                        </tbody>
                                      
                                    </table>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

 <script src="js/js1/jquery.data Tables.js"></script>

    <script src="js/data-table/dataTables.bootstrap.min.js"></script>
    <script src="js/data-table/jquery.dataTables.min.js"></script>
    <script src="js/data-table/jquery-1.12.4.js"></script>

    <script src="js/datatables/datatables.min.js"></script>
    <script src="js/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="js/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="js/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="js/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script src="js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.js"></script>
    <script src="js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js"></script>
   <!--  <script src="js/datatables/datatables-init.js"></script> -->
    <script type="text/javascript">
            $('#bootstrap-data-table-export3').DataTable({
        lengthMenu: [[5, 10, 20,25, 50, 75, 100, -1], [5, 10, 20, 25, 50, 75, 100, "All"]], 
        dom: 'lBfrtip',
        buttons: [
           {
                extend: 'copyHtml5',
                title: 'Allergies List',
                filename: 'Allergies List',
                exportOptions: {
                    columns: [ 0, 1 ,2, 3  ]
                }
            }, {
                extend: 'csvHtml5',
                title: 'Allergies List',
                filename: 'Allergies List',
                exportOptions: {
                    columns: [ 0, 1 ,2, 3 ]
                }
            }, {
                extend: 'excelHtml5',
                title: 'Allergies List',
                filename: 'Allergies List',
                exportOptions: {
                    columns: [ 0, 1 ,2, 3  ]
                }
            },  {
                extend: 'pdfHtml5',
                 title: 'Allergies List',
                filename: 'Allergies List',
                exportOptions: {
                    columns: [ 0, 1 ,2, 3  ]
                }
            }, {
                extend: 'print',
                title: 'Allergies List',
                filename: 'Allergies List',
                exportOptions: {
                    columns: [ 0, 1 ,2, 3  ]
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
    </script>
           @endsection