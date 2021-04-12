
@extends('layouts.home', ['activePage' => 'Tests'])

@section('content')
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Urinalysis</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST" action="{{ route('update_urinalysis', $Urinalysis->id)}}"  enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
										<label>Patient Name</label>
                                        <select class="select" name="patient_id">
                                           <option value="{{$Urinalysis->patient_id}}">{{$Urinalysis->Patient->first_name}} {{$Urinalysis->Patient->last_name}}</option>
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
											<option value="{{$Urinalysis->employee_id}}">{{$Urinalysis->Employee->first_name}} {{$Urinalysis->Employee->last_name}}</option>
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
                                            <input type="number" value="{{$Urinalysis->result}}" class="form-control" name="result" >
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea cols="30" rows="4" name="comment" class="form-control"> {{$Urinalysis->comment}}</textarea>
                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Update Urinalysis</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endsection