<?php

use App\Http\Controllers\AbsensiKaryawanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\UserController;
use App\Models\AbsensiKaryawan;
use Illuminate\Support\Facades\Route;

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

Route::redirect('/', '/login');

// Route::get('/register', [RegisterController::class, 'index'])->name('auth.index');
Route::group(['middleware' => ['guest']], function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);
});

Route::group(['middleware' => ['auth']], function () {
    /**
     * Admin Role Routes
     */
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('dashboard', [HomeController::class, 'index']);
        Route::post('dashboard', [UserController::class, 'store'])->name('auth.create');
        Route::patch('dashboard/{id}', [HomeController::class, 'update'])->name('auth.update');
        Route::delete('/dashboard/{id}', [HomeController::class, 'destroy'])->name('auth.delete');
    });

    /**
     * Staff Role Routes
     */

    Route::group(['middleware' => ['role:staff']], function () {
        // Route::get('staff', function () {
        //     return view('welcome');
        // });
        Route::get('staff', [PayrollController::class, 'index'])->name('staff.index');
        Route::get('staff/data-payroll', [PayrollController::class, 'payrollIndex'])->name('staff.payroll-index');
        Route::get('staff/data-absensi', [PayrollController::class, 'absensiIndex'])->name('staff.absensi-index');
        Route::patch('staff/{id}', [PayrollController::class, 'update'])->name('staff.update');
        Route::post('staff/payroll', [PayrollController::class, 'doPayroll'])->name('staff.payroll');
        /**Generate PDF */
        Route::get('staff/cetak', [PayrollController::class, 'generatePDF'])->name('export.pdf');
        Route::get('staff/cetak/{id}', [PayrollController::class, 'generatePDFOne'])->name('export.pdf-one');
    });
    /**
     * Karyawan Role Routes
     */
    // Route::group(['middleware' => ['role:karyawan']], function () {
        Route::get('si-absensi', [AbsensiKaryawanController::class, 'index']);
        Route::post('si-absensi', [AbsensiKaryawanController::class, 'store'])->name('absensi.create');
    // });


    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});
