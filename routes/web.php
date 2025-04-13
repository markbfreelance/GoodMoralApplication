<?php

use App\Http\Controllers\RegistrarController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HeadOSAController;
use App\Http\Controllers\Auth\RegisterViolationController;
use App\Http\Controllers\DeanController;
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

// Registrar Dashboard Route
Route::get('/registrar/dashboard', [RegistrarController::class, 'dashboard'])
  ->middleware(['auth', 'verified'])
  ->name('registrar.dashboard');

// Approve Application Route
Route::patch('/registrar/application/{id}/approve', [RegistrarController::class, 'approve'])
  ->middleware(['auth', 'verified'])
  ->name('registrar.approve');

// Reject Application Route
Route::delete('/registrar/application/{id}/reject', [RegistrarController::class, 'reject'])
  ->middleware(['auth', 'verified'])
  ->name('registrar.reject');

// ============================================================================================== //

// Head_OSA Dashboard Route
Route::get('/head_osa/dashboard', [HeadOSAController::class, 'dashboard'])
  ->middleware(['auth', 'verified'])
  ->name('head_osa.dashboard');

// Approve Head_OSA Application Route
Route::patch('/head_osa/application/{id}/approve', [HeadOSAController::class, 'approve'])
  ->middleware(['auth', 'verified'])
  ->name('head_osa.approve');

// Reject Head_OSA Application Route
Route::delete('/head_osa/application/{id}/reject', [HeadOSAController::class, 'reject'])
  ->middleware(['auth', 'verified'])
  ->name('head_osa.reject');

//Dean
Route::get('/dean/dashboard', [DeanController::class, 'dashboard'])
  ->middleware(['auth', 'verified'])
  ->name('dean.dashboard');

// Approve Head_OSA Application Route
Route::patch('/dean/application/{id}/approve', [DeanController::class, 'approve'])
  ->middleware(['auth', 'verified'])
  ->name('dean.approve');

// Reject Head_OSA Application Route
Route::delete('/dean/application/{id}/reject', [DeanController::class, 'reject'])
  ->middleware(['auth', 'verified'])
  ->name('dean.reject');

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
