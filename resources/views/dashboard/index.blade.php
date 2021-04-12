
@extends('layouts.home', ['activePage' => 'dashboard'])

@section('content')
	@if(Auth::user()->role == 'patient')
	<div class="row">
		
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                        <div class="dash-widget">
							<span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
							<div class="dash-widget-info text-right">
								<h3>{{$BP_count}}</h3>
								<span class="widget-title1">BP test #<i class="fa fa-check" aria-hidden="true"></i></span>
							</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3>{{$BP_count + $Chest_count + $Kidney_count + $Glucose_count + $Other_count + $Urinalysis_count}}</h3>
                                <span class="widget-title2">Total Test Taken <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-4">
                        <div class="dash-widget">
                            <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3>{{$Treatment_count}}</h3>
                                <span class="widget-title3">Treated <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>


                   
					<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
						<div class="card">
							<div class="card-body">
								<div class="chart-title">
									<h4>Appointments</h4>
									<!-- <span class="float-right"><i class="fa fa-caret-up" aria-hidden="true"></i> 15% Higher than Last Month</span> -->
								</div>	
								<div class="card-body p-0">
								<div class="table-responsive">
									<table class="table mb-0">
										<thead class="d-none">
											<tr>
												<th>Patient Name</th>
												<th>Doctor Name</th>
												<th>Timing</th>
												<th class="text-right">Status</th>
											</tr>
										</thead>
										<tbody>
											@foreach($Appointment as $appoint)
											<tr>
												<td style="min-width: 200px;">
													<a class="avatar" href="profile.html">B</a>
													<h2><a href="{{ route('patient_profile', ['id' => $appoint->patient_id] ) }}">{{$appoint->Patient->first_name}} {{$appoint->Patient->last_name}} <span>Lilongwe</span></a></h2>
												</td>                 
												<td>
													<h5 class="time-title p-0">Appointment With</h5>
													<p>{{$appoint->Employee->first_name}} {{$appoint->Employee->last_name}}</p>
												</td>
												<td>
													<h5 class="time-title p-0">Timing</h5>
													<p>{{$appoint->time}}</p>
												</td>
												<td class="text-right">
													<a href="{{ route('edit_appointment', ['id' => $appoint->id] ) }}" class="btn btn-outline-primary take-btn">Take up</a>
												</td>
											</tr>
											@endforeach
											
										</tbody>
									</table>
								</div>
							</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-lg-6 col-xl-6">
						<div class="card">
							<div class="card-body">
								<div class="chart-title">
									<h4>Tips</h4>
									
								</div>	
								
							</div>
						</div>
					</div>
		
                    
                </div>
				
					
				

	@else
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
							<span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
							<div class="dash-widget-info text-right">
								<h3>{{$Employee_count}}</h3>
								<span class="widget-title1">Health personnel <i class="fa fa-check" aria-hidden="true"></i></span>
							</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3>{{$Patient_count}}</h3>
                                <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3>{{$Treatment_count}}</h3>
                                <span class="widget-title3">Treated <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h3>{{$Patient_count - $Treatment_count}}</h3>
                                <span class="widget-title4">Pending <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="row">
					<div class="col-12 col-md-6 col-lg-6 col-xl-6">
						<div class="card">
							<div class="card-body">
								<div class="chart-title">
									<h4>Patient Total</h4>
									<span class="float-right"><i class="fa fa-caret-up" aria-hidden="true"></i> 15% Higher than Last Month</span>
								</div>	
								<canvas id="linegraph"></canvas>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 col-lg-6 col-xl-6">
						<div class="card">
							<div class="card-body">
								<div class="chart-title">
									<h4>Patients In</h4>
									
								</div>	
								<canvas id="bargraph"></canvas>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-md-6 col-lg-8 col-xl-8">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title d-inline-block">Upcoming Appointments</h4> <a href="appointments.html" class="btn btn-primary float-right">View all</a>
							</div>
							<div class="card-body p-0">
								<div class="table-responsive">
									<table class="table mb-0">
										<thead class="d-none">
											<tr>
												<th>Patient Name</th>
												<th>Doctor Name</th>
												<th>Timing</th>
												<th class="text-right">Status</th>
											</tr>
										</thead>
										<tbody>
											@foreach($Appointment as $appoint)
											<tr>
												<td style="min-width: 200px;">
													<a class="avatar" href="profile.html">B</a>
													<h2><a href="{{ route('patient_profile', ['id' => $appoint->patient_id] ) }}">{{$appoint->Patient->first_name}} {{$appoint->Patient->last_name}} <span>Lilongwe</span></a></h2>
												</td>                 
												<td>
													<h5 class="time-title p-0">Appointment With</h5>
													<p>{{$appoint->Employee->first_name}} {{$appoint->Employee->last_name}}</p>
												</td>
												<td>
													<h5 class="time-title p-0">Timing</h5>
													<p>{{$appoint->time}}</p>
												</td>
												<td class="text-right">
													<a href="{{ route('edit_appointment', ['id' => $appoint->id] ) }}" class="btn btn-outline-primary take-btn">Take up</a>
												</td>
											</tr>
											@endforeach
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
                    <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                        <div class="card member-panel">
							<div class="card-header bg-white">
								<h4 class="card-title mb-0">Doctors</h4>
							</div>
                            <div class="card-body">
                                <ul class="contact-list">
                                	@foreach($Doctors as $doctor)
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">{{$doctor->first_name}} {{$doctor->last_name}}</span>
                                                <span class="contact-date">{{$doctor->email}}</span>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                   
                                      
                                </ul>
                            </div>
                            
                        </div>
                    </div>
				</div>
				<div class="row">
					<div class="col-12 col-md-6 col-lg-8 col-xl-8">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title d-inline-block">New Patients </h4> <a href="patients.html" class="btn btn-primary float-right">View all</a>
							</div>
							<div class="card-block">
								<div class="table-responsive">
									<table class="table mb-0 new-patient-table">
										<tbody>
											@foreach($New_patient as $patient)
											<tr>
												<td>
													<img width="28" height="28" class="rounded-circle" src="assets/img/user.jpg" alt=""> 
													<h2>{{$patient->first_name}} {{$patient->last_name}}</h2>
												</td>
												<td>{{$patient->email}}</td>
												<td>{{$patient->phone_number}}</td>
												<td><button class="btn btn-primary btn-primary-one float-right">Checkup</button></td>
											</tr>
											@endforeach
											
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					
				</div>

				@endif

           @endsection