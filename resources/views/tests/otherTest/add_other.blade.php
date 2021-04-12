
@extends('layouts.home', ['activePage' => 'Tests'])

@section('content')
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Other Test</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST" action="{{ route('store_other')}}"  enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Patient Name</label>
                                        <select class="select" name="patient_id">
                                            <option value="">Select</option>
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
                                            <option value="">Select</option>
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
                                        <label>Test Name</label>
                                            <input type="text" class="form-control" name="test_name" >
                                    </div>
                                </div>
                               <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Results</label>
                                            <input type="text" class="form-control" name="results" >
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Comment</label>
                                <textarea cols="30" rows="4" name="comment" class="form-control"></textarea>
                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Create Other Test</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endsection