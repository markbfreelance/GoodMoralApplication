<?php

use App\Http\Controllers\ProgramCoordinatorController;
use App\Http\Controllers\RegistrarController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HeadOSAController;
use App\Http\Controllers\SecOSAController;
use App\Http\Controllers\Auth\RegisterViolationController;
use App\Http\Controllers\DeanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
  return view('welcome');
});


Route::get('/dashboard', [ApplicationController::class, 'dashboard'])
  ->middleware(['auth', 'verified'])
  ->name('dashboard');

Route::get('/notification', [ApplicationController::class, 'notification'])
  ->middleware(['auth', 'verified'])
  ->name('notification');

Route::get('/notificationViolation', [ApplicationController::class, 'notificationViolation'])
  ->middleware(['auth', 'verified'])
  ->name('notificationViolation');

//admin route==================================================================================================================================================================
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
  ->middleware(['auth', 'verified'])
  ->name('admin.dashboard');


Route::get('/admin/Application', [AdminController::class, 'applicationDashboard'])
  ->middleware(['auth', 'verified'])
  ->name('admin.Application');
Route::get('/admin/psgApplication', [AdminController::class, 'psgApplication'])
  ->middleware(['auth', 'verified'])
  ->name('admin.psgApplication');

Route::patch('/admin/psgApplication/{student_id}/approve', [AdminController::class, 'approvepsg'])
  ->middleware(['auth', 'verified'])
  ->name('admin.approvepsg');

Route::delete('/admin/psgApplication/{student_id}/reject', [AdminController::class, 'rejectpsg'])
  ->middleware(['auth', 'verified'])
  ->name('admin.rejectpsg');

Route::delete('/admin/Addviolation/{id}/delete', [AdminController::class, 'deleteViolation'])
  ->middleware(['auth', 'verified'])
  ->name('admin.deleteViolation');

Route::patch('/admin/violation/update/{id}', [AdminController::class, 'updateViolation'])
  ->middleware(['auth', 'verified'])
  ->name('admin.updateViolation');

Route::get('/admin/GMAApporvedByRegistrar', [AdminController::class, 'GMAApporvedByRegistrar'])
  ->middleware(['auth', 'verified'])
  ->name('admin.GMAApporvedByRegistrar');

Route::get('/admin/violation', [AdminController::class, 'violation'])
  ->middleware(['auth', 'verified'])
  ->name('admin.violation');

Route::patch('/admin/application/{id}/approve', [AdminController::class, 'approveGMA'])
  ->middleware(['auth', 'verified'])
  ->name('admin.approveGMA');

// Reject Head_OSA Application Route==================================================================================================================================================================
Route::delete('/admin/application/{id}/reject', [AdminController::class, 'rejectGMA'])
  ->middleware(['auth', 'verified'])
  ->name('admin.rejectGMA');


//Psg_Officer==================================================================================================================================================================
Route::get('/PsgOfficer/dashboard', function () {
  return view('PsgOfficer.dashboard');
})->middleware(['auth', 'verified'])->name('PsgOfficer.dashboard');

Route::get('/admin/AddViolation', [AdminController::class, 'AddViolationDashboard'])
  ->middleware(['auth', 'verified'])
  ->name('admin.AddViolation');

Route::get('/PsgOfficer/PsgAddViolation', [RegisterViolationController::class, 'ViolatorDashboard'])
  ->middleware(['auth', 'verified'])
  ->name('PsgOfficer.PsgAddViolation');


Route::get('/PsgOfficer/Violator', [RegisterViolationController::class, 'violator'])
  ->middleware(['auth', 'verified'])
  ->name('PsgOfficer.Violator');

// Registrar Dashboard Route==================================================================================================================================================================
Route::get('/registrar/dashboard', [RegistrarController::class, 'dashboard'])
  ->middleware(['auth', 'verified'])
  ->name('registrar.dashboard');

Route::get('/registrar/psgApplication', [RegistrarController::class, 'psgApplication'])
  ->middleware(['auth', 'verified'])
  ->name('registrar.psgApplication');

Route::patch('/registrar/psgApplication/{student_id}/approve', [RegistrarController::class, 'approvepsg'])
  ->middleware(['auth', 'verified'])
  ->name('registrar.approvepsg');

Route::delete('/registrar/psgApplication/{student_id}/reject', [RegistrarController::class, 'rejectpsg'])
  ->middleware(['auth', 'verified'])
  ->name('registrar.rejectpsg');



// Approve Application Route==================================================================================================================================================================
Route::patch('/registrar/application/{id}/approve', [RegistrarController::class, 'approve'])
  ->middleware(['auth', 'verified'])
  ->name('registrar.approve');


// Reject Application Route
Route::delete('/registrar/application/{id}/reject', [RegistrarController::class, 'reject'])
  ->middleware(['auth', 'verified'])
  ->name('registrar.reject');
// ============================================================================================== =================================================================================//

// Head_OSA Dashboard Route==================================================================================================================================================================
Route::get('/head_osa/dashboard', [HeadOSAController::class, 'dashboard'])
  ->middleware(['auth', 'verified'])
  ->name('head_osa.dashboard');

// Approve Head_OSA Application Route==================================================================================================================================================================
Route::patch('/head_osa/application/{id}/approve', [HeadOSAController::class, 'approve'])
  ->middleware(['auth', 'verified'])
  ->name('head_osa.approve');

// Reject Head_OSA Application Route==================================================================================================================================================================
Route::delete('/head_osa/application/{id}/reject', [HeadOSAController::class, 'reject'])
  ->middleware(['auth', 'verified'])
  ->name('head_osa.reject');

// Sec_OSA Dashboard Route==================================================================================================================================================================
Route::get('/sec_osa/dashboard', [SecOSAController::class, 'dashboard'])
  ->middleware(['auth', 'verified'])
  ->name('sec_osa.dashboard');

// Sec_OSA Application Route==================================================================================================================================================================
Route::get('/sec_osa/application', [SecOSAController::class, 'application'])
  ->middleware(['auth', 'verified'])
  ->name('sec_osa.application');

// Approve Sec_OSA Application Route==================================================================================================================================================================
Route::patch('/application/{id}/approve', [SecOSAController::class, 'approve'])
  ->middleware(['auth', 'verified'])
  ->name('sec_osa.approve');


// Reject Sec_OSA Application Route==================================================================================================================================================================
Route::delete('/sec_osa/application/{id}/reject', [SecOSAController::class, 'reject'])
  ->middleware(['auth', 'verified'])
  ->name('sec_osa.reject');

Route::get('/sec_osa/minor', [SecOSAController::class, 'minor'])
  ->middleware(['auth', 'verified'])
  ->name('sec_osa.minor');

Route::get('/sec_osa/major', [SecOSAController::class, 'major'])
  ->middleware(['auth', 'verified'])
  ->name('sec_osa.major');

Route::post('/sec_osa/upload/{id}', [SecOSAController::class, 'uploadDocument'])
  ->name('sec_osa.document');


// DEAN ROUTES ======================================================================================
Route::middleware(['auth', 'verified'])->prefix('dean')->name('dean.')->group(function () {
  Route::get('/dashboard', [DeanController::class, 'dashboard'])->name('dashboard');
  Route::get('/application', [DeanController::class, 'application'])->name('application');
  Route::patch('/application/{id}/approve', [DeanController::class, 'approve'])->name('approve');
  Route::delete('/application/{id}/reject', [DeanController::class, 'reject'])->name('reject');
  Route::get('/major', [DeanController::class, 'major'])->name('major');
  Route::get('/minor', [DeanController::class, 'minor'])->name('minor');
});

Route::middleware('auth')->group(function () {
  // Route to handle applying for Good Moral Certificate
  Route::post('/apply/good-moral-certificate', [ApplicationController::class, 'applyForGoodMoralCertificate'])->name('apply.good_moral_certificate');
});


Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Program Coordinator ROUTES ======================================================================================
Route::get('/prog_coor/dashboard', [ProgramCoordinatorController::class, 'dashboard'])
  ->middleware(['auth', 'verified'])
  ->name('prog_coor.dashboard');

Route::get('/prog_coor/minor', [ProgramCoordinatorController::class, 'minor'])
  ->middleware(['auth', 'verified'])
  ->name('prog_coor.minor');

Route::get('/prog_coor/major', [ProgramCoordinatorController::class, 'major'])
  ->middleware(['auth', 'verified'])
  ->name('prog_coor.major');

Route::get('/prog_coor/dashboard', [ProgramCoordinatorController::class, 'dashboard'])
  ->middleware(['auth', 'verified'])
  ->name('prog_coor.dashboard');

require __DIR__ . '/auth.php';
