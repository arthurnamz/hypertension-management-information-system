
@extends('layouts.home', ['activePage' => 'Tests'])

@section('content')
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit BP Test</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST" action="{{ route('update_bp', $BP_measurements->id)}}"  enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
										<label>Patient Name</label>
                                        <select class="select" name="patient_id">
                                           <option value="{{$BP_measurements->patient_id}}">{{$BP_measurements->Patient->first_name}} {{$BP_measurements->Patient->last_name}}</option>
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
											<option value="{{$BP_measurements->employee_id}}">{{$BP_measurements->Employee->first_name}} {{$BP_measurements->Employee->last_name}}</option>
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
                                        <label>Systolic</label>
                                        <div class="cal-icon">
                                            <input type="number" value="{{$BP_measurements->systolic}}" class="form-control" name="systolic" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Diastolic</label>
                                        <div class="time-icon">
                                            <input type="number" value="{{$BP_measurements->diastolic}}" class="form-control" name="diastolic"  >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pulse Rate</label>
                                        <div class="time-icon">
                                            <input type="number" value="{{$BP_measurements->pulse_rate}}" class="form-control" name="pulse_rate"  >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea cols="30" rows="4" name="comment" class="form-control"> {{$BP_measurements->comment}}</textarea>
                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Update BP Test</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endsection