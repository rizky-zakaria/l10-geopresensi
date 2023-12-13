<?php

use App\Http\Controllers\Admin\BidangController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\LokasiController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Pegawai\ApelPagiController;
use App\Http\Controllers\Pegawai\ApelSoreController;
use App\Http\Controllers\Pegawai\DalamRuanganController;
use App\Http\Controllers\Pegawai\SakitController;
use App\Http\Controllers\Pegawai\SetelahIshomaController;
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
    return redirect(url('login'));
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::prefix('admin')->group(function () {
        Route::prefix('data-master')->group(function () {
            Route::resource('pegawai', PegawaiController::class);
            Route::resource('lokasi', LokasiController::class);
            Route::resource('bidang', BidangController::class);
        });
        Route::resource('presensi', LaporanController::class);
        Route::post('presensi/cetak', [LaporanController::class, 'cetakLaporan']);
    });
    Route::prefix('pegawai')->group(function () {
        Route::get('apel-pagi', [ApelPagiController::class, 'index']);
        Route::get('apel-pagi/create', [ApelPagiController::class, 'create'])->name('apel-pagi.create');
        Route::post('apel-pagi/store-lokasi', [ApelPagiController::class, 'postLokasi'])->name('apel-pagi.postLokasi');
        Route::get('apel-pagi/success', [ApelPagiController::class, 'successPost']);

        Route::get('dalam-ruangan', [DalamRuanganController::class, 'index']);
        Route::get('dalam-ruangan/create', [DalamRuanganController::class, 'create'])->name('dalam-ruangan.create');
        Route::post('dalam-ruangan/store-lokasi', [DalamRuanganController::class, 'postLokasi'])->name('dalam-ruangan.postLokasi');
        Route::get('dalam-ruangan/success', [DalamRuanganController::class, 'successPost']);

        Route::get('setelah-ishoma', [SetelahIshomaController::class, 'index']);
        Route::get('setelah-ishoma/create', [SetelahIshomaController::class, 'create'])->name('setelah-ishoma.create');
        Route::post('setelah-ishoma/store-lokasi', [SetelahIshomaController::class, 'postLokasi'])->name('setelah-ishoma.postLokasi');
        Route::get('setelah-ishoma/success', [SetelahIshomaController::class, 'successPost']);

        Route::get('apel-sore', [ApelSoreController::class, 'index']);
        Route::get('apel-sore/create', [ApelSoreController::class, 'create'])->name('apel-sore.create');
        Route::post('apel-sore/store-lokasi', [ApelSoreController::class, 'postLokasi'])->name('apel-sore.postLokasi');
        Route::get('apel-sore/success', [ApelSoreController::class, 'successPost']);

        Route::resource('sakit', SakitController::class);
    });
});
Route::post('apel-pagi/upload-image', [ApelPagiController::class, 'postImage'])->name('apel-pagi.image');
Route::post('dalam-ruangan/upload-image', [DalamRuanganController::class, 'postImage'])->name('dalam-ruangan.image');
Route::post('setelah-ishoma/upload-image', [SetelahIshomaController::class, 'postImage'])->name('setelah-ishoma.image');
Route::post('apel-sore/upload-image', [ApelSoreController::class, 'postImage'])->name('apel-sore.image');
