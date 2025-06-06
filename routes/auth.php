<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredAccountController;
use App\Http\Controllers\Auth\RegisterViolationController;
use App\Http\Controllers\SecOSAController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DeanController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ProgramCoordinatorController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
  Route::get('register', [RegisteredUserController::class, 'create'])
    ->name('register');

  Route::post('register', [RegisteredUserController::class, 'store']);

  Route::get('login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');

  Route::post('login', [AuthenticatedSessionController::class, 'store']);

  Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    ->name('password.request');

  Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    ->name('password.email');

  Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    ->name('password.reset');
});

Route::middleware('auth')->group(function () {
  Route::get('verify-email', EmailVerificationPromptController::class)
    ->name('verification.notice');

  Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['signed', 'throttle:6,1'])
    ->name('verification.verify');

  Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    ->middleware('throttle:6,1')
    ->name('verification.send');

  Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    ->name('password.confirm');

  Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

  Route::put('password', [PasswordController::class, 'update'])->name('password.update');

  Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    ->name('logout');

  Route::get('registeraccount', [RegisteredAccountController::class, 'create'])
    ->name('registeraccount');

  Route::post('registeraccount', [RegisteredAccountController::class, 'store']);


  Route::get('registerviolation', [RegisterViolationController::class, 'create'])
    ->name('registerviolation');

  Route::post('registerviolation', [RegisterViolationController::class, 'store']);

  Route::get('psgsearch', [RegisterViolationController::class, 'search'])
    ->name('psgsearch');

  Route::post('RegisterViolation', [AdminController::class, 'create'])
    ->name('RegisterViolation');

  Route::get('adminApplicationSearch', [AdminController::class, 'search'])
    ->name('adminApplicationSearch');

  Route::get('sec_osaSearch', [SecOSAController::class, 'search'])
    ->name('sec_osaSearch');

  Route::post('/violations/{id}/mark-downloaded', [AdminController::class, 'markDownloaded'])->name('violations.markDownloaded');
  Route::post('/violations/{id}/close', [AdminController::class, 'closeCase'])->name('violations.closeCase');

  Route::get('violationsearch', [AdminController::class, 'violationsearch'])
    ->name('violationsearch');

  Route::get('CoorMajorSearch', [ProgramCoordinatorController::class, 'CoorMajorSearch'])
    ->name('CoorMajorSearch');

  Route::get('DeanMinorSearch', [DeanController::class, 'DeanMinorSearch'])
    ->name('DeanMinorSearch');

  Route::get('DeanMajorSearch', [DeanController::class, 'DeanMajorSearch'])
    ->name('DeanMajorSearch');

  Route::post('dean/violation/approve/{id}', [DeanController::class, 'deanviolationapprove'])
    ->name('dean.violation.approve');

  Route::get('/admin/AddAccount', [AdminController::class, 'AddAccountnt'])
    ->name('admin.AddAccount');

  Route::post('/receipt/upload', [ApplicationController::class, 'upload'])->name('receipt.upload');
});
