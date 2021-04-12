
@extends('layouts.home', ['activePage' => 'allergy'])

@section('content')
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Allergy</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST" action="{{ route('update_allergy', $Allergies->id)}}"  enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
										<label>Patient Name</label>
                                        <select class="select" name="patient_id">
                                           <option value="{{$Allergies->patient_id}}">{{$Allergies->Patient->first_name}} {{$Allergies->Patient->last_name}}</option>
                                            @foreach( $Patient as $patie)
                                            <option value="{{$patie->id}}">{{$patie->first_name}} {{$patie->last_name}}</option>
                                            @endforeach
                                        </select>
										<!-- <input class="form-control" name="patient_id" type="text" value="APT-0001" readonly=""> -->
									</div>
                                </div>
                                <div class="col-md-6">
									<div class="form-group">
										<label>Health Personel</label>
										<select class="select" name="employee_id">
											<option value="{{$Allergies->employee_id}}">{{$Allergies->Employee->first_name}} {{$Allergies->Employee->last_name}}</option>
                                            @foreach( $Employee as $emp)
											<option value="{{$emp->id}}">{{$emp->first_name}} {{$emp->last_name}}</option>
											@endforeach
										</select>
									</div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Allergy name</label>
                                        <div class="cal-icon">
                                            <input type="text" value="{{$Allergies->name}}" class="form-control" name="name" >
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Update Allergies</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endsection