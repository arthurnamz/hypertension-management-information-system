<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::group(['middleware' => 'auth'], function (){
 // routes for dashboard
Route::get('/dashboard', 'Backend\dashboardController@index')->name('dashboard');

 // routes for patient
Route::get('/patients', 'Backend\patientController@index')->name('patients');
Route::get('/add_patient', 'Backend\patientController@create')->name('add_patient');
Route::post('/store_patient', 'Backend\patientController@store')->name('store_patient');
Route::get('/patient_profile/{id}', 'Backend\patientController@show')->name('patient_profile');
Route::get('/edit_patient/{id}', 'Backend\patientController@edit')->name('edit_patient');
Route::post('/update_patient/{id}', 'Backend\patientController@update')->name('update_patient');
Route::post('/delete_patient/{id}', 'Backend\patientController@destroy')->name('delete_patient');



 // routes for employee
Route::get('/employees', 'Backend\employeeController@index')->name('employees');
Route::get('/add_employee', 'Backend\employeeController@create')->name('add_employee');
Route::post('/store_employee', 'Backend\employeeController@store')->name('store_employee');
Route::get('/employee_profile/{id}', 'Backend\employeeController@show')->name('employee_profile');
Route::get('/edit_employee/{id}', 'Backend\employeeController@edit')->name('edit_employee');
Route::post('/update_employee/{id}', 'Backend\employeeController@update')->name('update_employee');
Route::post('/delete_employee/{id}', 'Backend\employeeController@destroy')->name('delete_employee');

 // routes for appointment
Route::get('/appointment', 'Backend\appointmentController@index')->name('appointment');
Route::get('/add_appointment', 'Backend\appointmentController@create')->name('add_appointment');
Route::post('/store_appointment', 'Backend\appointmentController@store')->name('store_appointment');
Route::post('/update_appointment/{id}', 'Backend\appointmentController@update')->name('update_appointment');
Route::get('/edit_appointment/{id}', 'Backend\appointmentController@edit')->name('edit_appointment');
Route::post('/delete_appointment/{id}', 'Backend\appointmentController@destroy')->name('delete_appointment');

 // routes for BP measurements
Route::get('/bp_test', 'Backend\bpmeasurementsController@index')->name('bp_test');
Route::get('/add_bp', 'Backend\bpmeasurementsController@create')->name('add_bp');
Route::post('/store_bp', 'Backend\bpmeasurementsController@store')->name('store_bp');
Route::post('/update_bp/{id}', 'Backend\bpmeasurementsController@update')->name('update_bp');
Route::get('/edit_bp/{id}', 'Backend\bpmeasurementsController@edit')->name('edit_bp');
Route::post('/delete_bp/{id}', 'Backend\bpmeasurementsController@destroy')->name('delete_bp');
Route::get('/view_test/{id}', 'Backend\bpmeasurementsController@show')->name('view_test');

// routes for Glucose Test
Route::get('/glucose_test', 'Backend\glucose_testController@index')->name('glucose_test');
Route::get('/add_glucose', 'Backend\glucose_testController@create')->name('add_glucose');
Route::post('/store_glucose', 'Backend\glucose_testController@store')->name('store_glucose');
Route::post('/update_glucose/{id}', 'Backend\glucose_testController@update')->name('update_glucose');
Route::get('/edit_glucose/{id}', 'Backend\glucose_testController@edit')->name('edit_glucose');
Route::post('/delete_glucose/{id}', 'Backend\glucose_testController@destroy')->name('delete_glucose');
Route::get('/view_glucose/{id}', 'Backend\glucose_testController@show')->name('view_glucose');

// routes for Kidney Test
Route::get('/kidney_test', 'Backend\kidney_testController@index')->name('kidney_test');
Route::get('/add_kidney', 'Backend\kidney_testController@create')->name('add_kidney');
Route::post('/store_kidney', 'Backend\kidney_testController@store')->name('store_kidney');
Route::post('/update_kidney/{id}', 'Backend\kidney_testController@update')->name('update_kidney');
Route::get('/edit_kidney/{id}', 'Backend\kidney_testController@edit')->name('edit_kidney');
Route::post('/delete_kidney/{id}', 'Backend\kidney_testController@destroy')->name('delete_kidney');
Route::get('/view_kidney/{id}', 'Backend\kidney_testController@show')->name('view_kidney');

// routes for Other Tests
Route::get('/other_test', 'Backend\other_testController@index')->name('other_test');
Route::get('/add_other', 'Backend\other_testController@create')->name('add_other');
Route::post('/store_other', 'Backend\other_testController@store')->name('store_other');
Route::post('/update_other/{id}', 'Backend\other_testController@update')->name('update_other');
Route::get('/edit_other/{id}', 'Backend\other_testController@edit')->name('edit_other');
Route::post('/delete_other/{id}', 'Backend\other_testController@destroy')->name('delete_other');
Route::get('/view_other/{id}', 'Backend\other_testController@show')->name('view_other');

// routes for Allergies
Route::get('/allergy', 'Backend\allergiesController@index')->name('allergy');
Route::get('/add_allergy', 'Backend\allergiesController@create')->name('add_allergy');
Route::post('/store_allergy', 'Backend\allergiesController@store')->name('store_allergy');
Route::post('/update_allergy/{id}', 'Backend\allergiesController@update')->name('update_allergy');
Route::get('/edit_allergy/{id}', 'Backend\allergiesController@edit')->name('edit_allergy');
Route::post('/delete_allergy/{id}', 'Backend\allergiesController@destroy')->name('delete_allergy');
Route::get('/view_allergy/{id}', 'Backend\allergiesController@show')->name('view_allergy');


// routes for Treatment Tests
Route::get('/treatment', 'Backend\treatmentController@index')->name('treatment');
Route::get('/add_treatment', 'Backend\treatmentController@create')->name('add_treatment');
Route::post('/store_treatment', 'Backend\treatmentController@store')->name('store_treatment');
Route::post('/update_treatment/{id}', 'Backend\treatmentController@update')->name('update_treatment');
Route::get('/edit_treatment/{id}', 'Backend\treatmentController@edit')->name('edit_treatment');
Route::post('/delete_treatment/{id}', 'Backend\treatmentController@destroy')->name('delete_treatment');
Route::get('/view_treatment/{id}', 'Backend\treatmentController@show')->name('view_treatment');

// routes for Chest Tests
Route::get('/chest_test', 'Backend\chest_xrayController@index')->name('chest_test');
Route::get('/add_chest', 'Backend\chest_xrayController@create')->name('add_chest');
Route::post('/store_chest', 'Backend\chest_xrayController@store')->name('store_chest');
Route::post('/update_chest/{id}', 'Backend\chest_xrayController@update')->name('update_chest');
Route::get('/edit_chest/{id}', 'Backend\chest_xrayController@edit')->name('edit_chest');
Route::post('/delete_chest/{id}', 'Backend\chest_xrayController@destroy')->name('delete_chest');
Route::get('/view_chest/{id}', 'Backend\chest_xrayController@show')->name('view_chest');

// routes for Urinalysis
Route::get('/urinalysis', 'Backend\urinalysisController@index')->name('urinalysis');
Route::get('/add_urinalysis', 'Backend\urinalysisController@create')->name('add_urinalysis');
Route::post('/store_urinalysis', 'Backend\urinalysisController@store')->name('store_urinalysis');
Route::post('/update_urinalysis/{id}', 'Backend\urinalysisController@update')->name('update_urinalysis');
Route::get('/edit_urinalysis/{id}', 'Backend\urinalysisController@edit')->name('edit_urinalysis');
Route::post('/delete_urinalysis/{id}', 'Backend\urinalysisController@destroy')->name('delete_urinalysis');
Route::get('/view_urinalysis/{id}', 'Backend\urinalysisController@show')->name('view_urinalysis');

 // routes for schedule
Route::get('/schedule', 'Backend\scheduleController@index')->name('schedule');
Route::get('/add_schedule', 'Backend\scheduleController@create')->name('add_schedule');
Route::post('/store_schedule', 'Backend\scheduleController@store')->name('store_schedule');
Route::get('/edit_schedule/{id}', 'Backend\scheduleController@edit')->name('edit_schedule');
Route::post('/update_schedule/{id}', 'Backend\scheduleController@update')->name('update_schedule');
Route::post('/delete_schedule/{id}', 'Backend\scheduleController@destroy')->name('delete_schedule');

 // routes for hospital
Route::get('/hospital', 'Backend\hospitalController@index')->name('hospital');
Route::get('/add_hospital', 'Backend\hospitalController@create')->name('add_hospital');
Route::post('/store_hospital', 'Backend\hospitalController@store')->name('store_hospital');
Route::post('/delete_hospital/{id}', 'Backend\hospitalController@destroy')->name('delete_hospital');
Route::get('/edit_hospital/{id}', 'Backend\hospitalController@edit')->name('edit_hospital');
Route::post('/update_hospital/{id}', 'Backend\hospitalController@update')->name('update_hospital');
});
Auth::routes();


