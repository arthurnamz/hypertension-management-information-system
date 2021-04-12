
@extends('layouts.home', ['activePage' => 'appointment'])

@section('content')

                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Appointment</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST" action="{{ route('update_appointment', $Appointment->id)}}"  enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Patient Name</label>
                                        <select class="select" name="patient_id">
                                    
                                            <option value="{{$Appointment->patient_id}}">{{$Appointment->Patient->first_name}} {{$Appointment->Patient->last_name}}</option>
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
                                           <option value="{{$Appointment->employee_id}}">{{$Appointment->Employee->first_name}} {{$Appointment->Employee->last_name}}</option>
                                            @foreach( $Employee as $emp)
                                            <option value="{{$emp->id}}">{{$emp->first_name}} {{$emp->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <div class="cal-icon">
                                            <input type="date" class="form-control" name="date" placeholder="yyyy-mm-dd" value="{{$Appointment->date}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Time</label>
                                        <div class="time-icon">
                                            <input type="time" class="form-control" name="time" value="{{$Appointment->time}}" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Message</label>
                                <textarea cols="30" rows="4" name="comment" class="form-control">{{$Appointment->comment}}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="display-block">Appointment Status</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="product_active" value="attended" >
                                    <label class="form-check-label" for="product_active">
                                    Attended
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="product_inactive" value="unattended">
                                    <label class="form-check-label" for="product_inactive">
                                    Unattended
                                    </label>
                                </div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Update Appointment</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endsection