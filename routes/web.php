<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/inicio/welcome', function () {
    return view('welcome');
})->name('welcome');
Route::get('/users', function () {
    return view('users.index');
})->name('users.index');
Route::get('/appraisals', [App\Http\Controllers\TasacionesController::class, 'index'])->name('appraisals.index');


use App\Http\Controllers\TasacionesController;

Route::get('/appraisals/individualization', [TasacionesController::class, 'step1'])->name('appraisals.step1');
Route::post('/appraisals/expropriating-body', [TasacionesController::class, 'step2'])->name('appraisals.step2');
Route::post('/appraisals/utility-law', [TasacionesController::class, 'step3'])->name('appraisals.step3');
Route::post('/appraisals/notification-of-art', [TasacionesController::class, 'step4'])->name('appraisals.step4');
Route::post('/appraisals/acceptance-of-amount', [TasacionesController::class, 'step5'])->name('appraisals.step5');
Route::post('/appraisals/index', [TasacionesController::class, 'finish'])->name('appraisals.finish');

use App\Http\Controllers\JudicialController;

// Rutas para el proceso judicial
Route::get('/judicial/judicial-action', [JudicialController::class, 'step6'])->name('judicial.step6');
Route::post('/judicial/compensation-amount', [JudicialController::class, 'step7'])->name('judicial.step7');
Route::post('/judicial/transfer-of-ownership', [JudicialController::class, 'step8'])->name('judicial.step8');
Route::post('/judicial/bulletin', [JudicialController::class, 'step9'])->name('judicial.step9');
Route::post('/judicial/observations', [JudicialController::class, 'step10'])->name('judicial.step10');
Route::post('/judicial/finish', [JudicialController::class, 'finish'])->name('judicial.finish');

Route::get('/account', function () {
    return view('users.account');
})->name('account');

use App\Http\Controllers\Auth\PasswordRecoveryController;

Route::get('/password/recovery', [PasswordRecoveryController::class, 'showRecoveryForm'])->name('password.recovery');
Route::post('/password/recovery', [PasswordRecoveryController::class, 'submitRecoveryForm'])->name('password.recovery.submit');
