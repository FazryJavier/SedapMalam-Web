<?php

use App\Http\Controllers\DataAnakController;
use App\Http\Controllers\DataOrangtuaController;
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
    return view('User.home');
});
Route::get('/dashboard', function () {
    return view('Admin.Pages.dashboard');
});

// Route::get('/Data-Anak', function () {
//     return view('Admin.Pages.DataAnak.index');
// });

// Route::get('/Data-Orangtua', function () {
//     return view('Admin.Pages.DataOrangtua.index');
// });

Route::get('/Data-Kader', function () {
    return view('Admin.Pages.DataKader.index');
});

Route::get('/Timbang-Anak', function () {
    return view('Admin.Pages.TimbangAnak.index');
});

Route::get('/Grafik-Perkembangan', function () {
    return view('Admin.Pages.GrafikPerkembangan.index');
});

// Admin
// Data Orangtua
Route::get('/data-orangtua', [DataOrangtuaController::class, 'index']);
Route::post('/data-orangtua', [DataOrangtuaController::class, 'store']);
Route::get('/data-orangtua/{id}/update', [DataOrangtuaController::class, 'edit']);
Route::put('/data-orangtua/{id}', [DataOrangtuaController::class, 'update']);
Route::delete('/data-orangtua/{id}', [DataOrangtuaController::class, 'destroy']);

// Data Anak
Route::get('/data-anak', [DataAnakController::class, 'index']);
Route::post('/data-anak', [DataAnakController::class, 'store']);
Route::get('/data-anak/{id}/update', [DataAnakController::class, 'edit']);
Route::put('/data-anak/{id}', [DataAnakController::class, 'update']);
Route::delete('/data-anak/{id}', [DataAnakController::class, 'destroy']);