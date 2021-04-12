@extends('layouts.home', ['activePage' => 'hospital'])

@section('content')
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Hospital</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST" action="{{ route('store_hospital')}}"  enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
										<label>Hospital Name</label>
										<input class="form-control" type="text" name="name" required>
									</div>
                                </div>
                                <div class="col-md-6">
									<div class="form-group">
										<label>Location</label>
										<input class="form-control" type="text" name="location" required>
									</div>
                                </div>
                            </div>
                            
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Create Hospital</button>
                            </div>
                        </form>
                    </div>
                </div>
           @endsection