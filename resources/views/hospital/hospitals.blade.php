@extends('layouts.home', ['activePage' => 'hospital'])

@section('content')
                <div class="row">
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Appointments</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="{{ route('add_hospital')}}" class="btn btn btn-primary btn-rounded float-right"><i class="fa fa-plus"></i> Add Hospital</a>
                    </div>
                </div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-striped custom-table">
								<thead>
									<tr>
										<th>#</th>
										<th>Name</th>
										<th>location</th>
										<th class="text-right">Action</th>
									</tr>
								</thead>
								<tbody>
                                    @foreach($Hospital as $hospa)
									<tr>
										<td>{{$loop->iteration}}</td>
										<td>{{$hospa->name}}</td>
										<td>{{$hospa->location}}</td>
										
										<td class="text-right">
											<div class="dropdown dropdown-action">
												<a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
												<div class="dropdown-menu dropdown-menu-right">
													<a class="dropdown-item" href="{{ route('edit_hospital', ['id' => $hospa->id] ) }}"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                    
                                                     <form method="POST" action=" {{ route('delete_hospital', $hospa->id)}}" enctype="multipart/form-data">
                                                         @csrf
													
                                                    <button class="dropdown-item" type="submit"  data-toggle="modal" data-target="#delete_appointment"><i class="fa fa-trash-o m-r-5"></i>  Delete </button>
                                                    </form>
												</div>
											</div>
										</td>
									</tr>
                                    @endforeach
								</tbody>
							</table>
						</div>
					</div>
                </div>
        @endsection