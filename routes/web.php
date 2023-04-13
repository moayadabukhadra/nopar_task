<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true, 'register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth','role:administrator'])->group(function () {
    /* Company Routes */
    Route::group(['name' => 'company.'], function () {
        Route::get('companies', [CompanyController::class, 'index'])->name('index');
        Route::prefix('company')->group(function () {
            Route::get('show/{company?}', [CompanyController::class, 'show'])->name('show');
            Route::post('store/{company?}', [CompanyController::class, 'store'])->name('store');
            Route::post('destroy/{company}', [CompanyController::class, 'destroy'])->name('destroy');
        });
    });

    /* Employee Routes */
    Route::group(['name' => 'employee.'], function () {
        Route::get('employees', [EmployeeController::class, 'index'])->name('index');
        Route::prefix('employee')->group(function () {
            Route::get('show/{employee?}', [EmployeeController::class, 'show'])->name('show');
            Route::post('store/{employee?}', [EmployeeController::class, 'store'])->name('store');
            Route::post('destroy/{employee}', [EmployeeController::class, 'destroy'])->name('destroy');
        });
    });

    Route::post('/logout', function () {
        Auth::logout();
        return redirect('/login');
    })->name('logout');
});
