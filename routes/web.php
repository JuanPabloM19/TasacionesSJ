<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\TasacionesController;
use App\Http\Controllers\JudicialController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return Auth::check() ? redirect()->route('dashboard') : redirect()->route('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'login'])->name('login.store');
    Route::post('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout');

    Route::get('/dashboard', function () {
        return view('welcome');
    })->name('dashboard');

    Route::get('/inicio/welcome', function () {
        return view('welcome');
    })->name('welcome');
    // Route::get('/users', function () {
    //     return view('users.index');
    // })->name('users.index');

    Route::get('/appraisals', [App\Http\Controllers\TasacionesController::class, 'index'])->name('appraisals.index');

    Route::get('/appraisals/individualization/{id?}', [TasacionesController::class, 'step1'])->name('appraisals.step1');
    Route::post('/appraisals/individualization/{id?}', [TasacionesController::class, 'step1']);

    Route::get('/appraisals/expropriating-body/{id}', [TasacionesController::class, 'step2'])->name('appraisals.step2');
    Route::post('/appraisals/expropriating-body/{id}', [TasacionesController::class, 'step2']);

    Route::get('/appraisals/utility-law/{id}', [TasacionesController::class, 'step3'])->name('appraisals.step3');
    Route::post('/appraisals/utility-law/{id}', [TasacionesController::class, 'step3']);

    Route::get('/appraisals/notification-of-art/{id}', [TasacionesController::class, 'step4'])->name('appraisals.step4');
    Route::post('/appraisals/notification-of-art/{id}', [TasacionesController::class, 'step4']);

    Route::get('/appraisals/acceptance-of-amount/{id}', [TasacionesController::class, 'step5'])->name('appraisals.step5');
    Route::post('/appraisals/acceptance-of-amount/{id}', [TasacionesController::class, 'step5']);

    Route::post('/appraisals/finish', [TasacionesController::class, 'finish'])->name('appraisals.finish');

    Route::delete('/appraisals/{id}', [TasacionesController::class, 'destroy'])->name('appraisals.destroy');

    Route::get('/appraisals/{id}/updateStatus/{status}', [TasacionesController::class, 'updateStatus'])->name('appraisals.updateStatus');

    // Rutas para el proceso judicial
    Route::get('/judicial/judicial-action', [JudicialController::class, 'step6'])->name('judicial.step6');
    Route::post('/judicial/compensation-amount', [JudicialController::class, 'step7'])->name('judicial.step7');
    Route::post('/judicial/transfer-of-ownership', [JudicialController::class, 'step8'])->name('judicial.step8');
    Route::post('/judicial/bulletin', [JudicialController::class, 'step9'])->name('judicial.step9');
    Route::post('/judicial/observations', [JudicialController::class, 'step10'])->name('judicial.step10');
    Route::post('/judicial/finish', [JudicialController::class, 'finish'])->name('judicial.finish');

    Route::get('/account', function () {
        return view('users.account', ['user' => Auth::user()]);
    })->middleware(['auth'])->name('account');

    Route::post('/account/update', [ProfileController::class, 'updateAccount'])->name('account.update');

    Route::get('/users', [UsuarioController::class, 'index'])->name('users.index');
    Route::post('/users', [UsuarioController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UsuarioController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UsuarioController::class, 'destroy'])->name('users.destroy');

});

Route::post('/forgot-password', [ForgotPasswordController::class, 'recover'])->name('password.email');
Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm']);
Route::put('/reset-password/{token}', [ForgotPasswordController::class, 'updatePassword'])->name('password.update');


require __DIR__.'/auth.php';
