<?php

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
Route::get('/dasboard', function () {
    return view('Admin.Pages.dashboard');
});

Route::get('/Data-Anak', function () {
    return view('Admin.Pages.DataAnak.index');
});

Route::get('/Data-Orangtua', function () {
    return view('Admin.Pages.DataOrangtua.index');
});

Route::get('/Data-Kader', function () {
    return view('Admin.Pages.DataKader.index');
});

Route::get('/Timbang-Anak', function () {
    return view('Admin.Pages.TimbangAnak.index');
});

Route::get('/Grafik-Perkembangan', function () {
    return view('Admin.Pages.GrafikPerkembangan.index');
});
