<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\EmployeeController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;



Route::middleware('guest')->group(function () {

    Route::get('register', [RegisteredUserController::class, 'create']) ->name('register');
    Route::post('register', [RegisteredUserController::class, 'store']);

//---------login -------------------------

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])  ->name('login');

 //---------login User-------------------------

    Route::post('login/user', [AuthenticatedSessionController::class, 'store'])->name('login.user');


//---------login Admin-------------------------

    Route::post('login/admin', [AdminController::class, 'store'])->name('login.admin');

    
//---------employee Admin-------------------------

    Route::post('login/employee', [EmployeeController::class, 'store'])->name('login.employee');






  Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

   Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');

              
});
//--------------------end middleware---------------------------------


//-----------------------------log out ------------------------------------------------------


Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout.user');

Route::post('logout/admin', [AdminController::class, 'destroy'])->middleware('auth:admin')->name('logout.admin');

Route::post('logout/employee', [EmployeeController::class, 'destroy'])->middleware('auth:employee')->name('logout.employee');

//----------------------------------------------------------------------------



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




});
