<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SpecialtyController;
use App\Http\Controllers\AjaxController;

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

Route::get('/', function(){
     return view('welcome');
});

Auth::routes(['verify' => true]);

Auth::routes();

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Auth::routes();

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/role');
})->middleware(['auth', 'signed'])->name('verification.verify');

Auth::routes();

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Auth::routes();

// BACKOFFICE
Route::group(['middleware' => ['auth'], 'as' => 'backoffice.'], function() {
    Route::get('admin', [AdminController::class, 'show'])->name('admin.show');

    Route::resource('user', UserController::class);    
    Route::get('user_import', [UserController::class, 'import'])->name('user.import');
    Route::post('user_make_import', [UserController::class, 'make_import'])->name('user.make_import');

    Route::get('patient/{user}/schedule', [PatientController::class, 'back_schedule'])->name('patient.schedule');
    Route::post('patient/{user}/store_back_schedule', [PatientController::class, 'store_back_schedule'])->name('patient.store_back_schedule');

    Route::get('backoffice/appointments', [PatientController::class, 'show_appointments'])->name('patient.appointments.show');
    Route::get('backoffice/doctor/{user}/appointments', [PatientController::class, 'show_doctor_appointments'])->name('doctor.appointments.show');
    Route::get('patient/{user}/appointments', [PatientController::class, 'back_appointments'])->name('patient.appointments');
    Route::get('patient/{user}/appointments/{appointment}/edit', [PatientController::class, 'back_appointments_edit'])->name('patient.appointments.edit');
    Route::post('patient/{user}/appointments/{appointment}/update', [PatientController::class, 'back_appointments_update'])->name('patient.appointments.update');

    Route::get('patient/{user}/invoices', [PatientController::class, 'back_invoices'])->name('patient.invoices');
    Route::get('patient/{user}/invoices/{invoice}/edit', [PatientController::class, 'back_invoices_edit'])->name('patient.invoices.edit');
    Route::post('patient/{user}/invoices/{invoice}/update', [PatientController::class, 'back_invoices_update'])->name('patient.invoices.update');
    
    Route::resource('role', RoleController::class);
    Route::get('user/{user}/assign_role', [UserController::class, 'assign_role'])->name('user.assign_role');
    Route::post('user/{user}/role_assignment', [UserController::class, 'role_assignment'])->name('user.role_assignment');

    Route::resource('permission', PermissionController::class);
    Route::get('user/{user}/assign_permission', [UserController::class, 'assign_permission'])->name('user.assign_permission');
    Route::post('user/{user}/permission_assignment', [UserController::class, 'permission_assignment'])->name('user.permission_assignment');

    Route::resource('specialty', SpecialtyController::class);
    Route::get('user/{user}/assign_specialty', [UserController::class, 'assign_specialty'])->name('user.assign_specialty');
    Route::post('user/{user}/specialty_assignment', [UserController::class, 'specialty_assignment'])->name('user.specialty_assignment');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['as' =>'frontoffice.'], function() {
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('profile/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('profile/{user}/update', [UserController::class, 'update'])->name('user.update');
    Route::get('profile/edit_password', [UserController::class, 'edit_password'])->name('user.edit_password');
    Route::put('profile/change_password', [UserController::class, 'change_password'])->name('user.change_password');

    Route::get('patient/schedule',[PatientController::class, 'schedule'])->name('patient.schedule');
    Route::post('patient/schedule',[PatientController::class, 'store_schedule'])->name('patient.store_schedule');
    Route::get('patient/appointments',[PatientController::class, 'appointments'])->name('patient.appointments');
    Route::get('patient/prescriptions',[PatientController::class, 'prescriptions'])->name('patient.prescriptions');
    Route::get('patient/invoices',[PatientController::class, 'invoices'])->name('patient.invoices');
});

Route::group(['middleware' => ['auth'], 'as' => 'ajax.'], function() {
    Route::get('user_specialty', [AjaxController::class, 'user_specialty'])->name('user_specialty');
    Route::get('invoice_info', [AjaxController::class, 'invoice_info'])->name('invoice_info');
});

