
@extends('layouts.home', ['activePage' => 'allergy'])

@section('content')
               <link href="{{ asset('css/styleee.css')}}" rel="stylesheet">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Allergies</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="{{ route('allergy')}}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-refresh"></i>Back to Allergies</a>
                    </div>
                </div>
                <div class="row">
                    
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
               
                                <div class="table-responsive">
                                    <table id="bootstrap-data-table-export3" class="display nowrap table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                        <th>No.</th>
                                         @if(Auth::user()->role != 'patient')
                                        <th>Patient Name</th>
                                        @endif
                                        <th>Allergy Name</th>
                                        <th>Test Date</th>
                                        <th>Tested By</th>
                                         @if(Auth::user()->role != 'patient')
                                        <th>Action</th>
                                        @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($Allergies as $allergy)
                                        <tr>
                                            <td>{{$loop -> iteration }}</td>  
                                             @if(Auth::user()->role != 'patient')               
                                            <td>{{$allergy->pfname}} {{$allergy->plname}}</td>
                                            @endif
                                            <td>{{$allergy->name}}</td>
                                            <td>{{$allergy->tested_date}}</td>
                                            <td>{{$allergy->efname}} {{$allergy->elname}}</td>
                                             @if(Auth::user()->role != 'patient')
                                            <td>
                                                <form method="POST" action=" {{ route('delete_allergy', $allergy->id)}}" enctype="multipart/form-data">
                                                         @csrf
                                                    
                                                    <a href="{{ route('edit_allergy', ['id' => $allergy->id] ) }}" class="btn btn-sm btn-info btn-round">Edit</a>
                                                    <button type="submit"  class="btn btn-sm btn-danger btn-round">Delete</button>
                                                </form>
                                            </td>
                                            @endif
                                        </tr>
                                          @endforeach
                                        </tbody>
                                      
                                    </table>
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

 <script src="{{ asset('js/js1/jquery.data Tables.js')}}"></script>

    <script src="{{ asset('js/data-table/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/data-table/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('js/data-table/jquery-1.12.4.js')}}"></script>

    <script src="{{ asset('js/datatables/datatables.min.js')}}"></script>
    <script src="{{ asset('js/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js')}}"></script>
    <script src="{{ asset('js/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js')}}"></script>
    <script src="{{ asset('js/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js')}}"></script>
    <script src="{{ asset('js/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js')}}"></script>
    <script src="{{ asset('js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.js')}}"></script>
    <script src="{{ asset('js/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.colVis.min.js')}}"></script>
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
                    columns: [ 0, 1 ,2, 3 ,4  ]
                }
            }, {
                extend: 'csvHtml5',
                title: 'Allergies List',
                filename: 'Allergies List',
                exportOptions: {
                    columns: [ 0, 1 ,2, 3 ,4 ]
                }
            }, {
                extend: 'excelHtml5',
                title: 'Allergies List',
                filename: 'Allergies List',
                exportOptions: {
                    columns: [ 0, 1 ,2, 3 ,4  ]
                }
            },  {
                extend: 'pdfHtml5',
                 title: 'Allergies List',
                filename: 'Allergies List',
                exportOptions: {
                    columns: [ 0, 1 ,2, 3 ,4  ]
                }
            }, {
                extend: 'print',
                title: 'Allergies List',
                filename: 'Allergies List',
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