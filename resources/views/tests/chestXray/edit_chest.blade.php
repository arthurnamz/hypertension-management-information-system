
@extends('layouts.home', ['activePage' => 'Tests'])

@section('content')
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Edit Chest Test</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST" action="{{ route('update_chest', $Chest_xray->id)}}"  enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Patient Name</label>
                                        <select class="select" name="patient_id">
                                           <option value="{{$Chest_xray->patient_id}}">{{$Chest_xray->Patient->first_name}} {{$Chest_xray->Patient->last_name}}</option>
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
                                            <option value="{{$Chest_xray->employee_id}}">{{$Chest_xray->Employee->first_name}} {{$Chest_xray->Employee->last_name}}</option>
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
                                        <label>File Name</label>                                        
                                            <input type="text" value="{{$Chest_xray->test_name}}" class="form-control" name="file_name" >                                      
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Results</label>                                        
                                            <input type="text" value="{{$Chest_xray->results}}" class="form-control" name="results" >                                     
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea cols="30" rows="4" name="comment" class="form-control"> {{$Chest_xray->comment}}</textarea>
                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Update Chest Test</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endsection