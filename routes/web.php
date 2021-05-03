<?php

use Illuminate\Support\Facades\Route;
// use Laravel\Fortify\Http\Controllers\EmailVerificationPromptController;
// use Illuminate\Support\Facades\Storage;


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

Route::get('/',function(){
    return view('dashboard');
});
Route::group(['middleware' => 'auth:sanctum','verified'], function () {
   Route::group(['middleware' => ['verified']], function () {

    // Route::get('/redirects', 'Homecontroller@index');
    Route::get('/redirects',function(){
        return view('dashboard');
    });


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


// patients
Route::resource('patients','patient\PatientsController');
Route::post('patients_update','patient\PatientsController@update');
// end patients
// department
Route::resource('departments','hr\DepartmentsController');
Route::post('departments_update','hr\DepartmentsController@update');
// end department 

// // Position
// Route::resource('positions','hr\PositionController');
// Route::post('positions_update','hr\PositionController@update');
// // end Position 

// employee
Route::resource('employees','hr\EmployeeController');
Route::get('employees/create/option','hr\EmployeeController@regoption');
Route::get('employees/create/docter','hr\EmployeeController@docterCreate');


Route::post('employees_update','hr\EmployeeController@update');
Route::get('employees/doc/download/{id?}/{type?}','hr\EmployeeController@download');
// 
Route::resource('payroll','hr\payrollController');
Route::post('payroll_status','hr\payrollController@status_change');
Route::post('payroll_update','hr\payrollController@update');
// 

// appoinments
Route::resource('appoinments','patient\AppoinmentsController');
Route::get('appoinments_get_position/{id?}','patient\AppoinmentsController@getpostition');
Route::get('get_test_via_department/{id?}','patient\AppoinmentsController@get_test_dep');
Route::get('get_test_fee/{id?}','patient\AppoinmentsController@get_test_fee');



Route::get('getDocterFees/{id?}','patient\AppoinmentsController@getdocterfee');
Route::post('appoinments_update','hr\payrollController@update');
// appoinments

//opd
Route::resource('opd','patient\OpdController');
Route::post('app_serach','patient\OpdController@serach');
Route::post('createRevisitRecord','patient\OpdController@revisitcreate');
Route::post('createtestRecord','patient\OpdController@testcreate');
Route::get('opdEditvisit/{id?}','patient\OpdController@getEditData');
Route::post('Updateopdvist','patient\OpdController@updateopdvisit');
Route::get('opdEdittest/{id?}','patient\OpdController@getTestEditData');
Route::post('Updateopdtest','patient\OpdController@updateopdtest');
// opd 
Route::resource('test','TestController');
Route::post('test_update','TestController@update');
// createRevisitRecord



// stock

// main Catagory pharmasi
Route::resource('medicines_cat','hr\PharmaMainCatagoryController');
Route::post('medicines_cat_update','hr\PharmaMainCatagoryController@update');
// main Catagory pharmasi

Route::resource('medicines','hr\MidicinesController');
Route::post('medicines_update','hr\MidicinesController@update');
Route::resource('purchase-mediciens','hr\PurchaseMidicinesController');
Route::get('medicineFiter/{id?}','hr\PurchaseMidicinesController@filter');
// 
// laboratory
Route::resource('lab-cat','hr\LabCatagoryController');
Route::post('lab_cat_update','hr\LabCatagoryController@update');


Route::resource('lab-materials','hr\LabMaterialController');
Route::resource('lab-purchase-materials','hr\PurchaselabMaterialController');
Route::post('materials_update','hr\PurchaselabMaterialController@update');

Route::get('material_filter/{id?}','hr\LabMaterialController@filter');


// suregery and delivery
Route::resource('surgery','hr\SurgeryController');
Route::post('surgery_update','hr\SurgeryController@update');

Route::resource('procedure','hr\ProcedureController');
Route::post('procedure_update','hr\ProcedureController@update');

Route::resource('surgery_registration','hr\patientOperationController');
Route::get('operation_reg_docters/{dep_id?}/{type?}','hr\patientOperationController@docter_reg_operate');
// 

// 
});
});