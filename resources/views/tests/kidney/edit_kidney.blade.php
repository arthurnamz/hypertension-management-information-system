
@extends('layouts.home', ['activePage' => 'Tests'])

@section('content')
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Kidney Test</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST" action="{{ route('update_kidney', $Kidney_Test->id)}}"  enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
										<label>Patient Name</label>
                                        <select class="select" name="patient_id">
                                           <option value="{{$Kidney_Test->patient_id}}">{{$Kidney_Test->Patient->first_name}} {{$Kidney_Test->Patient->last_name}}</option>
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
											<option value="{{$Kidney_Test->employee_id}}">{{$Kidney_Test->Employee->first_name}} {{$Kidney_Test->Employee->last_name}}</option>
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
                                        <label>Results</label>
                                        <div class="cal-icon">
                                            <input type="number" value="{{$Kidney_Test->results}}" class="form-control" name="results" >
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea cols="30" rows="4" name="comment" class="form-control"> {{$Kidney_Test->comment}}</textarea>
                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Update Glucose Test</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endsection