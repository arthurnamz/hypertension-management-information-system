@extends('layouts.home', ['activePage' => 'patient'])

@section('content')
<div class="card">
               <div class="card-body">
                 <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <h4 class="page-title">Add Patient</h4>
                    </div>
                </div>
              <hr />
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <form method="POST" action="{{ route('store_patient')}}"  enctype="multipart/form-data" >
                            @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>First Name <span class="text-danger">*</span></label>
                                        <input class="form-control" name="first_name" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Middle Name</label>
                                        <input class="form-control" name="middle_name" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input class="form-control" name="last_name" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Email <span class="text-danger">*</span></label>
                                        <input class="form-control" name="email" type="email">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input class="form-control" name="password" type="password">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input class="form-control" type="password">
                                    </div>
                                </div>
								<div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <div class="cal-icon">
                                            <input type="date" name="dob" class="form-control " placeholder="yyyy-mm-dd">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
									<div class="form-group gender-select">
										<label class="gen-label">Gender:</label>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" class="form-check-input" value="male">Male
											</label>
										</div>
										<div class="form-check-inline">
											<label class="form-check-label">
												<input type="radio" name="gender" class="form-check-input" value="female">Female
											</label>
										</div>
									</div>
                                </div>
								<div class="col-sm-12">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Phone Number</label>
												<input type="text" name="phone_number" class="form-control ">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Hospital</label>
												<select class="form-control select" name="hospital_id" required>
													@foreach($Hospital as $hosp)
													<option value="{{$hosp->id}}"> {{$hosp->name}}</option>
													@endforeach
												</select>
											</div>
										</div>
										
										<div class="col-sm-6 col-md-6 col-lg-4">
											<div class="form-group">
												<label>Village</label>
												<input type="hidden" name="role" value="patient" class="form-control">
												<input type="text" name="village" class="form-control">
											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-4">
											<div class="form-group">
												<label>T/A</label>
												<input type="text" name="T_A" class="form-control">
											</div>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-4">
											<div class="form-group">
												<label>District</label>
												<input type="text" name="district" class="form-control">
											</div>
										</div>
									</div>
								</div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Next of Kin </label>
                                        <input class="form-control" name="next_of_kin" type="text">
                                    </div>
                                </div>
                                <div class="col-sm-6">
									<div class="form-group">
										<label>Next of Kin phoneNumber</label>
										<input class="form-control" name="nok_phone_number" type="text">
									</div>
                                </div>
                            </div>
							<div class="form-group">
                                <label>National ID</label>
                                <input class="form-control" name="national_id" type="text">
                            </div>
                            <div class="form-group">
                                <label class="display-block">Disability</label>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="disability" id="doctor_active" value="Yes">
									<label class="form-check-label" for="doctor_active">
									Yes
									</label>
								</div>
								<div class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="disability" id="doctor_inactive" value="No">
									<label class="form-check-label" for="doctor_inactive">
									No
									</label>
								</div>
                            </div>
                            <div class="m-t-20 text-center">
                                <button class="btn btn-primary submit-btn">Create Patient</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
           @endsection