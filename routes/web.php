<?php

use Illuminate\Foundation\Application;
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

Route::get('/', [\App\Http\Controllers\HomeController::class, 'frontend'])->name('home.frontend');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [App\Http\Controllers\UserAvatarController::class, 'profile'])->name('profile');
    Route::post('/getpegawai', [App\Http\Controllers\PegawaiController::class, 'getPegawai'])->name('get.pegawai');
    Route::post('/updatepegawai', [App\Http\Controllers\UserAvatarController::class, 'update_pegawai'])->name('update.data.pegawai');
    Route::post('/updateprofile', [App\Http\Controllers\UserAvatarController::class, 'update_profile'])->name('update.profile');
    Route::post('/skpupdateatasan', [App\Http\Controllers\SkpController::class, 'update_atasan'])->name('skp.update.atasan');
    Route::get('/me', [App\Http\Controllers\UserAvatarController::class, 'profile'])->name('me');
    Route::post('/update_photo', [App\Http\Controllers\UserAvatarController::class, 'update_photo'])->name('user-profile-photo.update');
    Route::resource('skp', App\Http\Controllers\SkpController::class);
    Route::post('update_skp_rating', App\Http\Controllers\Api\UpdateStatusRatingSkpController::class)->name('update.skp.rating');
    Route::resource('kinerja', App\Http\Controllers\KinerjaController::class);
    Route::resource('instansi', App\Http\Controllers\InstansiController::class);
    Route::resource('indikator', App\Http\Controllers\IndikatorController::class);
    Route::resource('pegawai', App\Http\Controllers\PegawaiController::class);
    Route::get('ekspektasi_data/{jenis}/{skpid}', [App\Http\Controllers\EkspektasiController::class, 'data_ekspektasi_jenis'])->name('ekspektasi.data.jenis');
    Route::resource('ekspektasi', App\Http\Controllers\EkspektasiController::class);

    Route::group(['middleware' => ['role:super-admin|admin']], function () {
        Route::get('monitorskp', [App\Http\Controllers\SkpController::class, 'monitor'])->name('skp.monitor');
        Route::get('/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings');
        Route::post('/settings', [App\Http\Controllers\SettingController::class, 'store'])->name('settings.store');
    });

    Route::group(['middleware' => ['role:super-admin']], function () {
        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::resource('roles', App\Http\Controllers\RoleController::class);
    });
});
Route::get('manifest.json', [App\Http\Controllers\UserAvatarController::class, 'manifest_json'])->name('manifest.json');
