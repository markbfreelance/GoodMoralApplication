<?php

<<<<<<< HEAD
use App\Http\Controllers\HeadOSAController;
use App\Http\Controllers\RegistrarController;
=======
use App\Http\Controllers\RegistarController;
>>>>>>> e2eb4a3f743eaaca8e311d3a0e45c63bf5f190d2
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\RegisterViolationController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/dashboard', function () {
  return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
//admin route
Route::get('/admin/dashboard', function () {
  return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::get('/admin/AddAccount', function () {
  return view('admin.AddAccount');
})->middleware(['auth', 'verified'])->name('admin.AddAccount');

Route::get('/admin/Application', function () {
  return view('admin.Application');
})->middleware(['auth', 'verified'])->name('admin.Application');
//Psg_Officer
Route::get('/PsgOfficer/dashboard', function () {
  return view('PsgOfficer.dashboard');
})->middleware(['auth', 'verified'])->name('PsgOfficer.dashboard');

Route::get('/PsgOfficer/PsgAddViolation', function () {
  return view('PsgOfficer.PsgAddViolation');
})->middleware(['auth', 'verified'])->name('PsgOfficer.PsgAddViolation');

Route::get('/PsgOfficer/Violator', [RegisterViolationController::class, 'violator'])
  ->middleware(['auth', 'verified'])
  ->name('PsgOfficer.Violator');

<<<<<<< HEAD
// ============================================================================================== //

// Registrar Dashboard Route
Route::get('/registrar/dashboard', [RegistrarController::class, 'dashboard'])
=======
// Registar Dashboard Route
Route::get('/registar/dashboard', [RegistarController::class, 'dashboard'])
>>>>>>> e2eb4a3f743eaaca8e311d3a0e45c63bf5f190d2
  ->middleware(['auth', 'verified'])
  ->name('registar.dashboard');

// Approve Application Route
Route::patch('/registar/application/{id}/approve', [RegistarController::class, 'approve'])
  ->middleware(['auth', 'verified'])
  ->name('registar.approve');

// Reject Application Route
Route::delete('/registar/application/{id}/reject', [RegistarController::class, 'reject'])
  ->middleware(['auth', 'verified'])
  ->name('registar.reject');

// ============================================================================================== //

// Head_OSA Dashboard Route
Route::get('/head_osa/dashboard', [HeadOSAController::class, 'dashboard'])
  ->middleware(['auth', 'verified'])
  ->name('head_osa.dashboard');

//Dean
Route::get('/Dean/dashboard', function () {
  return view('Dean.dashboard');
})->middleware(['auth', 'verified'])->name('Dean.dashboard');

Route::middleware('auth')->group(function () {
  // Route to handle applying for Good Moral Certificate
  Route::post('/apply/good-moral-certificate', [ApplicationController::class, 'applyForGoodMoralCertificate'])->name('apply.good_moral_certificate');
});


Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
