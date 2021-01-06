<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;

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

    Route::get('user/{user}/assign_role', [UserController::class, 'assign_role'])->name('user.assign_role');
    Route::post('user/{user}/role_assignment', [UserController::class, 'role_assignment'])->name('user.role_assignment');
    Route::get('user/{user}/assign_permission', [UserController::class, 'assign_permission'])->name('user.assign_permission');
    Route::post('user/{user}/permission_assignment', [UserController::class, 'permission_assignment'])->name('user.permission_assignment');
    Route::resource('role', RoleController::class);
    Route::resource('permission', PermissionController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['as' =>'frontoffice.'], function() {
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('profile/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('profile/{user}/update', [UserController::class, 'update'])->name('user.update');
    Route::get('profile/edit_password', [UserController::class, 'edit_password'])->name('user.edit_password');
    Route::put('profile/change_password', [UserController::class, 'change_password'])->name('user.change_password');

    Route::get('patient/schedule',[PatientController::class, 'schedule'])->name('patient.schedule');
    Route::get('patient/appointments',[PatientController::class, 'appointments'])->name('patient.appointments');
    Route::get('patient/prescriptions',[PatientController::class, 'prescriptions'])->name('patient.prescriptions');
    Route::get('patient/invoices',[PatientController::class, 'invoices'])->name('patient.invoices');
});

