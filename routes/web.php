<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegistrasiController;
use App\Http\Controllers\Frontend\FrontendController;
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

// * frontend
Route::get('/', [FrontendController::class, 'index']);

// * auth
Route::get('login', [LoginController::class, 'index'])
    ->name('login');

Route::post('login', [LoginController::class, 'store']);

Route::post('logout', [LoginController::class, 'destroy'])
    ->name('logout');

Route::get('register', [RegistrasiController::class, 'index'])
    ->name('register');

Route::post('register', [RegistrasiController::class, 'index'])
    ->name('register');

Route::group(['namespace' => 'App\Http\Controllers\Backend', 'prefix' => 'control', 'as' => 'backend.', 'middleware' => ['sidebar_backend']], function () {
    Route::get('/', function () {
        return redirect('control/dashboard');
    });

    Route::get('dashboard', 'BackendController@index')->name('dashboard');

    // * report
    Route::get('report-general', 'ReportController@general')->name('report_general');
    Route::get('report-general-add', 'ReportController@addGeneral')->name('report_general_add');

    Route::get('general-list', 'ReportController@generalDataTable')->name('general_list');
    Route::post('save-general', 'ReportController@saveGeneral')->name('save_general');

    // * withdraws
    Route::get('withdraws', 'WithdrawsController@index')->name('withdraws');
    Route::get('withdraws-list', 'WithdrawsController@indexDataTable')->name('withdraws_list');
});
