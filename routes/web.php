<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SalariController;
use App\Http\Controllers\SalaryController;

Route::get('/', function () {
    return view('login');
});

Route::post('/login', [UserController::class, 'UserLogin'])->name('UserLogin');

Route::get('/dashboard-finance', function () {
    return view('Finance.dashboard');
});

Route::get('/dashboard-manager', function () {
    return view('Manager.dashboard');
});

Route::get('/dashboard-director', function () {
    return view('Director.dashboard');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/list-salary', [SalariController::class, 'listSalary'])->name('listSalary');
    Route::get('/add-salary', [SalariController::class, 'addSalary'])->name('Finance.addSalary');
    Route::post('/process-salary', [SalariController::class, 'storeSalary'])->name('Finance.storeSalary');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/list-payment', [SalariController::class, 'listPayment'])->name('Finance.listPayment');
    Route::post('/payment/{id}/process', [SalariController::class, 'processPayment'])->name('Finance.processPayment');
    Route::get('/payment/{id}', [SalariController::class, 'showPaymentForm'])->name('Finance.showPaymentForm');

    Route::patch('/salary/approve/{id}', [SalariController::class, 'approve'])->name('Manager.approve');
    Route::patch('/salary/reject/{id}', [SalariController::class, 'reject'])->name('Manager.reject');

    Route::get('/finance/export-excel', [SalariController::class, 'exportExcel'])->name('Finance.exportExcel');
    Route::get('/report-salary', [SalariController::class, 'showReports'])->name('Director.showReports');
    Route::get('/download-report/{file}', [SalariController::class, 'downloadReport'])->name('Director.downloadReport');
});
