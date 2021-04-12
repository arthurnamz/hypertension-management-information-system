
@extends('layouts.home', ['activePage' => 'Tests'])

@section('content')
               <link href="{{ asset('css/styleee.css')}}" rel="stylesheet">

            <div class="container-fluid">
            	<div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">BP Tests</h4>
                    </div>
                    @if(Auth::user()->role != 'patient')
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="{{ route('add_bp')}}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add BP Tests</a>
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
                                        <th>Systolic</th>
                                        <th>Diastolic</th>
                                        <th>Pulse Rate</th>
                                        <th>Test Date</th>
                                        <th>Tested By</th>                                   
                                        </tr>
                                        @else
                                        <tr>
                                        <th>No.</th>
										<th>Patient Name</th>
										<th>Gender</th>
										<th>Phnone Number</th>
                                        <th>Email</th>
										<th>Number of Tests</th>
                                        <th>Action</th>
                                        </tr>
                                        @endif
                                        </thead>
                                        <tbody>
                                        @foreach($BP_measurements as $bp)
                                        @if(Auth::user()->role == 'patient')
                                        <tr>
                                            <td>{{$loop -> iteration }}</td>  
                                            <td>{{$bp->systolic}}</td>
                                            <td>{{$bp->diastolic}}</td>
                                            <td>{{$bp->pulse_rate}}</td>
                                            <td>{{$bp->tested_date}}</td>
                                            <td>{{$bp->efname}} {{$bp->elname}}</td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td>{{$loop -> iteration }}</td>                 
                                            <td>{{$bp->pfname}} {{$bp->plname}}</td>
                                            <td>{{$bp->pgender}}</td>
                                            <td>{{$bp->pnumber}}</td>
                                            <td>{{$bp->pemail}}</td>
                                            <td>{{$bp->count}}</td>
                                            <td>
                                                
                                                    <a href="{{ route('view_test', ['id' => $bp->id] ) }}" class="btn btn-sm btn-success btn-round">View</a> 
                                                    
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
                title: 'Appointment List',
                filename: 'Appointment List',
                exportOptions: {
                    columns: [ 0, 1 ,2, 3 ,4  ]
                }
            }, {
                extend: 'csvHtml5',
                title: 'Appointment List',
                filename: 'Appointment List',
                exportOptions: {
                    columns: [ 0, 1 ,2, 3 ,4 ]
                }
            }, {
                extend: 'excelHtml5',
                title: 'Appointment List',
                filename: 'Appointment List',
                exportOptions: {
                    columns: [ 0, 1 ,2, 3 ,4  ]
                }
            },  {
                extend: 'pdfHtml5',
                 title: 'Appointment List',
                filename: 'Appointment List',
                exportOptions: {
                    columns: [ 0, 1 ,2, 3 ,4  ]
                }
            }, {
                extend: 'print',
                title: 'Appointment List',
                filename: 'Appointment List',
                exportOptions: {
                    columns: [ 0, 1 ,2, 3 ,4  ]
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