<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">
    <title>Smart BP</title>
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css"> -->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap-datetimepicker.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css')}}">
    

    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <div class="main-wrapper">
        <div class="header">
			<div class="header-left">
				<a href="index-2.html" class="logo">
					<img src="{{ asset('assets/img/logo.png')}}"  width="35" height="35" alt=""> <span>Smart BP</span>
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
               
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img">
							<img class="rounded-circle" src="{{ asset('assets/img/user.jpg')}}" width="24" alt="Admin">
							<span class="status online"></span>
						</span>
						<span> {{Auth::user()->first_name}} </span>
                    </a>
					<div class="dropdown-menu">
						{{-- <a class="dropdown-item" href="{{ route('employee_profile', ['id' => Auth::user()->id] ) }}">My Profile</a>
						<a class="dropdown-item" href="{{ route('edit_employee', ['id' => Auth::user()->id] ) }}">Edit Profile</a> --}}
						<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" >Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                    </form>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item" href="edit-profile.html">Edit Profile</a>
                    <a class="dropdown-item" href="settings.html">Settings</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" >Logout</a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                    </form>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    @if(Auth::user()->role == 'patient')
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="{{ $activePage == 'dashboard' ? ' active' : '' }}">
                            <a href="{{ route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <li class="{{ $activePage == 'patient' ? ' active' : '' }}">
                            <a href="{{ route('patient_profile', ['id' => Auth::user()->id] ) }}"><i class="fa fa-wheelchair " ></i> <span>Profile</span></a>
                        </li>
                        <li class="{{ $activePage == 'appointment' ? ' active' : '' }}">
                            <a href="{{ route('appointment')}}"><i class="fa fa-calendar"></i> <span>Appointments</span></a>
                        </li>
                        
                        <li class="submenu {{ $activePage == 'Tests' ? ' active' : '' }}">
                            <a href="#"><i class="fa fa-flag-o"></i> <span> Tests </span> <span class="menu-arrow "></span></a>
                            <ul style="display: none;">
                                <li><a href="{{ route('bp_test')}}"> BP Test </a></li>
                                <li><a href="{{ route('urinalysis')}}"> Urinalysis </a></li>
                                <li><a href="{{ route('chest_test')}}"> Chest X-ray </a></li>
                                <li><a href="{{ route('glucose_test')}}"> Glucose Test </a></li>
                                <li><a href="{{ route('kidney_test')}}"> Kidneys Test </a></li>
                                <li><a href="{{ route('other_test')}}"> Other Test </a></li>
                            </ul>
                        </li>
                        <li class="{{ $activePage == 'allergy' ? ' active' : '' }}">
                            <a href="{{ route('allergy')}}"><i class="fa fa-flask"></i> <span>Allergies</span></a>
                        </li>
                        <li class="{{ $activePage == 'treat' ? ' active' : '' }}">
                            <a href="{{ route('treatment')}}"><i class="fa fa-heartbeat"></i> <span>Treatment</span></a>
                        </li>
                      
                    </ul>
                    @else
                    <ul>
                        <li class="menu-title">Main</li>
                        <li class="{{ $activePage == 'dashboard' ? ' active' : '' }}">
                            <a href="{{ route('dashboard')}}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a>
                        </li>
                        <li class="{{ $activePage == 'employees' ? ' active' : '' }}">
                            <a href="{{ route('employees')}}"><i class="fa fa-user-md"></i> <span>Health personnel</span></a>
                        </li>
                        <li class="{{ $activePage == 'patient' ? ' active' : '' }}">
                            <a href="{{ route('patients')}}"><i class="fa fa-wheelchair " ></i> <span>Patients</span></a>
                        </li>
                        <li class="{{ $activePage == 'appointment' ? ' active' : '' }}">
                            <a href="{{ route('appointment')}}"><i class="fa fa-calendar"></i> <span>Appointments</span></a>
                        </li>
                        <li class="{{ $activePage == 'schedule' ? ' active' : '' }}">
                            <a href="{{ route('schedule')}}"><i class="fa fa-calendar-check-o"></i> <span>Personnel Schedule</span></a>
                        </li>
                        <li class="{{ $activePage == 'hospital' ? ' active' : '' }}">
                            <a href="{{ route('hospital')}}"><i class="fa fa-hospital-o"></i> <span>Hospitals</span></a>
                        </li>
                        
                        <li class="submenu {{ $activePage == 'Tests' ? ' active' : '' }}">
                            <a href="#"><i class="fa fa-flag-o"></i> <span> Tests </span> <span class="menu-arrow "></span></a>
                            <ul style="display: none;">
                                <li><a href="{{ route('bp_test')}}"> BP Test </a></li>
                                <li><a href="{{ route('urinalysis')}}"> Urinalysis </a></li>
                                <li><a href="{{ route('chest_test')}}"> Chest X-ray </a></li>
                                <li><a href="{{ route('glucose_test')}}"> Glucose Test </a></li>
                                <li><a href="{{ route('kidney_test')}}"> Kidneys Test </a></li>
                                <li><a href="{{ route('other_test')}}"> Other Test </a></li>
                            </ul>
                        </li>
                        <li class="{{ $activePage == 'allergy' ? ' active' : '' }}">
                            <a href="{{ route('allergy')}}"><i class="fa fa-flask"></i> <span>Allergies</span></a>
                        </li>
                        <li class="{{ $activePage == 'treat' ? ' active' : '' }}">
                            <a href="{{ route('treatment')}}"><i class="fa fa-heartbeat"></i> <span>Treatment</span></a>
                        </li>
                      
                    </ul>
                    @endif
                    
                </div>
            </div>
        </div>

         <div class="page-wrapper">
            <div class="content">
                 @yield('content')
            </div>

            <div class="notification-box">
                <div class="msg-sidebar notifications msg-noti">
                    <div class="topnav-dropdown-header">
                        <span>Messages</span>
                    </div>
                    <div class="drop-scroll msg-list-scroll" id="msg_list">
                        <ul class="list-box">
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">R</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Richard Miles </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item new-message">
                                        <div class="list-left">
                                            <span class="avatar">J</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">John Doe</span>
                                            <span class="message-time">1 Aug</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">T</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Tarah Shropshire </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">M</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Mike Litorus</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">C</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Catherine Manseau </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">D</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Domenic Houston </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">B</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Buster Wigton </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">R</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Rolland Webber </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">C</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author"> Claire Mapes </span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">M</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Melita Faucher</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">J</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Jeffery Lalor</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">L</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Loren Gatlin</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">T</span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">Tarah Shropshire</span>
                                            <span class="message-time">12:28 AM</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">Lorem ipsum dolor sit amet, consectetur adipiscing</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="chat.html">See all messages</a>
                    </div>
                </div>
            </div>
        </div>


         </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="{{ asset('assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="{{ asset('assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{ asset('assets/js/Chart.bundle.js')}}"></script>
    {{--<script src="{{ asset('assets/js/chart.js')}}"></script>--}}
    <script src="{{ asset('assets/js/app.js')}}"></script>

    <script src="{{ asset('assets/js/select2.min.js')}}"></script>
    <script src="{{ asset('assets/js/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap-datetimepicker.min.js')}}"></script>
    <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js')}}"></script>
    <script>
            $(function () {
                $('#datetimepicker3').datetimepicker({
                    format: 'LT'
                });
                $('#datetimepicker4').datetimepicker({
                    format: 'LT'
                });
            });
     </script>
      <script>
         $(document).ready(function() {
    
    // Bar Chart

    var barChartData = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July'],
        datasets: [{
            label: 'Dataset 1',
            backgroundColor: 'rgba(0, 158, 251, 0.5)',
            borderColor: 'rgba(0, 158, 251, 1)',
            borderWidth: 1,
            data: [35, 59, 80, 81, 56, 55, 40]
        }, {
            label: 'Dataset 2',
            backgroundColor: 'rgba(255, 188, 53, 0.5)',
            borderColor: 'rgba(255, 188, 53, 1)',
            borderWidth: 1,
            data: [28, 48, 40, 19, 86, 27, 90]
        }]
    };

    var ctx = document.getElementById('bargraph').getContext('2d');
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            responsive: true,
            legend: {
                display: false,
            }
        }
    });

    // Line Chart

    var lineChartData = {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
            label: "My First dataset",
            backgroundColor: "rgba(0, 158, 251, 0.5)",
            data: [100, 70, 20, 100, 120, 50, 70, 50, 50, 100, 50, 90]
        }, {
        label: "My Second dataset",
        backgroundColor: "rgba(255, 188, 53, 0.5)",
        fill: true,
        data: [28, 48, 40, 19, 86, 27, 20, 90, 50, 20, 90, 20]
        }]
    };
    
    var linectx = document.getElementById('linegraph').getContext('2d');
    window.myLine = new Chart(linectx, {
        type: 'line',
        data: lineChartData,
        options: {
            responsive: true,
            legend: {
                display: false,
            },
            tooltips: {
                mode: 'index',
                intersect: false,
            }
        }
    });
    
    // Bar Chart 2
    
    barChart();
    
    $(window).resize(function(){
        barChart();
    });
    
    function barChart(){
        $('.bar-chart').find('.item-progress').each(function(){
            var itemProgress = $(this),
            itemProgressWidth = $(this).parent().width() * ($(this).data('percent') / 100);
            itemProgress.css('width', itemProgressWidth);
        });
    };
});
     </script>

</body>
</html>