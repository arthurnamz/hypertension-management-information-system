@extends('layouts.home', ['activePage' => 'patient'])

@section('content')
                <div class="row">
                    <div class="col-sm-7 col-6">
                        <h4 class="page-title">My Profile</h4>
                    </div>
                    @if(Auth::user()->role != 'patient')
                    
                    <div class="col-sm-5 col-6 text-right m-b-30">
                        <a href="{{ route('edit_patient', ['id' => $Patient->id] ) }}" class="btn btn-primary btn-rounded"><i class="fa fa-plus"></i> Edit Profile</a>
                    </div>
                    @endif
                </div>
                <div class="card-box profile-header">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#"><img class="avatar" src="{{ asset('assets/img/doctor-03.jpg')}}" alt=""></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{$Patient -> first_name}} {{$Patient -> last_name}}</h3>
                                                <small class="text-muted">{{$Patient -> role}} </small>
                                                <div class="staff-id">Patientloyee ID : SBP-0{{$Patient -> id}}</div>
                                                <div class="staff-msg"><a href="chat.html" class="btn btn-primary">Send Message</a></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Phone:</span>
                                                    <span class="text"><a href="#">{{$Patient -> phone_number}}</a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Email:</span>
                                                    <span class="text"><a href="mailto:{{$Patient -> email}}">{{$Patient -> email}}</a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Birthday:</span>
                                                    <span class="text">{{$Patient -> dob}}</span>
                                                </li>
                                                <li>
                                                    <span class="title">Address:</span>
                                                    <span class="text">{{$Patient -> village}}, {{$Patient -> T_A}}, {{$Patient -> district}}</span>
                                                </li>
                                                <li>
                                                    <span class="title">Gender:</span>
                                                    <span class="text">{{$Patient -> gender}}</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
                <div class="profile-tabs">
                    <ul class="nav nav-tabs nav-tabs-bottom">
                        <li class="nav-item"><a class="nav-link active" href="#bp" data-toggle="tab">BP Tests</a></li>
                        <li class="nav-item"><a class="nav-link" href="#kidney" data-toggle="tab">Kidney Tests</a></li>
                        <li class="nav-item"><a class="nav-link" href="#urinal" data-toggle="tab">Urinalysis</a></li>
                         <li class="nav-item"><a class="nav-link" href="#glucose" data-toggle="tab">Glucose Test</a></li>
                         <li class="nav-item"><a class="nav-link" href="#chest" data-toggle="tab">Chest X-Ray</a></li>
                         <li class="nav-item"><a class="nav-link" href="#other" data-toggle="tab">Other Tests</a></li>
                         <li class="nav-item"><a class="nav-link" href="#allergy" data-toggle="tab">Allergies</a></li>
                         <li class="nav-item"><a class="nav-link" href="#treat" data-toggle="tab">Treatments</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane show active" id="bp">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h3 class="card-title">BP Tests Information</h3>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @foreach($BP_measurements as $bp)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <h4>Test was done by: <strong style="color: teal;"> {{$bp->Employee->first_name}} {{$bp->Employee->last_name}}</strong></h4>
                                                            <div><strong> Systolic : </strong>{{$bp->systolic}}</div>
                                                            <div><strong> diastolic : </strong>{{$bp->diastolic}}</div>
                                                            <div><strong> Pulse Rate : </strong>{{$bp->pulse_rate}}</div>
                                                            <div> <strong> Tested on  : </strong> <span style="color: green;">{{date('M j, Y', strtotime($bp->created_at))}}</span></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="kidney">
                             <div class="row">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h3 class="card-title">Kidney Function Tests Information</h3>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @foreach($Kidney_Test as $kidney)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <h4>Test was done by: <strong style="color: teal;">{{$kidney->Employee->first_name}} {{$kidney->Employee->last_name}}</strong></h4>
                                                            <div><strong> Result : </strong>{{$kidney->results}}</div>
                                                            <div><strong> Comment : </strong>{{$kidney->comment}}</div>
                                                            <div> <strong> Tested on  : </strong> <span style="color: green;"> {{date('M j, Y', strtotime($kidney->created_at))}}</span></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="urinal">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h3 class="card-title">Urinalysis Tests Information</h3>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @foreach($Urinalysis as $urine)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <h4>Test was done by: <strong style="color: teal;">{{$urine->Employee->first_name}} {{$urine->Employee->last_name}}</strong></h4>
                                                            <div><strong> Result : </strong>{{$urine->result}}</div>
                                                            <div><strong> Comment : </strong>{{$urine->comment}}</div>
                                                            <div> <strong> Tested on  : </strong> <span style="color: green;"> {{date('M j, Y', strtotime($urine->created_at))}}</span></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="glucose">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h3 class="card-title">Glucose Tests Information</h3>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @foreach($Glucose_Test as $glucose)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <h4>Test was done by: <strong style="color: teal;">{{$glucose->Employee->first_name}} {{$glucose->Employee->last_name}}</strong></h4>
                                                            <div><strong> Result : </strong>{{$glucose->results}}</div>
                                                            <div><strong> Comment : </strong>{{$glucose->comment}}</div>
                                                            <div> <strong> Tested on  : </strong> <span style="color: green;"> {{date('M j, Y', strtotime($glucose->created_at))}}</span></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="chest">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h3 class="card-title">Chest X-ray Tests Information</h3>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @foreach($Chest_xray as $chest)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <h4>Test was done by: <strong style="color: teal;">{{$chest->Employee->first_name}} {{$chest->Employee->last_name}}</strong></h4>
                                                            <div><strong> Result : </strong>{{$chest->results}}</div>
                                                            <div><strong> Comment : </strong>{{$chest->comment}}</div>
                                                            <div> <strong> Tested on  : </strong> <span style="color: green;"> {{date('M j, Y', strtotime($chest->created_at))}}</span></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="other">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h3 class="card-title">Other Tests Information</h3>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @foreach($Other_Test as $other)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <h4>Test was done by: <strong style="color: teal;">{{$other->Employee->first_name}} {{$other->Employee->last_name}}</strong></h4>
                                                            <div><strong> Test Name : </strong>{{$other->test_name}}</div>
                                                            <div><strong> Result : </strong>{{$other->results}}</div>
                                                            <div><strong> Comment : </strong>{{$other->comment}}</div>
                                                            <div> <strong> Tested on  : </strong> <span style="color: green;">  {{date('M j, Y', strtotime($other->created_at))}}</span></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="allergy">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h3 class="card-title">Allergies Information</h3>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @foreach($Allergies as $allergy)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <h4>Diagnosed was done by: <strong style="color: teal;">{{$allergy->Employee->first_name}} {{$allergy->Employee->last_name}}</strong></h4>
                                                            <div><strong> Allergy Name : </strong>{{$allergy->name}}</div>
                                                            <div> <strong> Tested on  : </strong> <span style="color: green;">  {{date('M j, Y', strtotime($allergy->created_at))}}</span></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="treat">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-box">
                                        <h3 class="card-title">Treament Information</h3>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @foreach($Treatment as $treat)
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <h4>Diagnosed was done by: <strong style="color: teal;">{{$treat->Employee->first_name}} {{$treat->Employee->last_name}}</strong></h4>
                                                            <div><strong> Medicine Name : </strong>{{$treat->name}}</div>
                                                            <div><strong> Comment : </strong>{{$treat->comment}}</div>
                                                            <div> <strong> Treated on  : </strong> <span style="color: green;">  {{date('M j, Y', strtotime($treat->created_at))}}</span></div>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
           @endsection