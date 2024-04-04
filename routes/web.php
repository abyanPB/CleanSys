<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SopController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\GroomingController;
use App\Http\Controllers\PjkpController;
use App\Livewire\GroomingLivewire;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['verified'])->name('dashboard');

    // Routes for cleaner
    Route::middleware(['cleaner'])->prefix('Cleaner')->group(function () {
        Route::get('/sop',[SopController::class, 'showSopCleaner'])->name('showSopCleaner');
        Route::get('/Laporan-Grooming/Index',[GroomingController::class, 'showLaporanGroomingCleaner'])->name('showLaporanGroomingCleaner');
        Route::get('/Laporan-Grooming/Create',[GroomingController::class, 'createLaporanGroomingCleaner'])->name('createLaporanGroomingCleaner');
        Route::post('/Laporan-Grooming/Create',[GroomingController::class, 'storeLaporanGroomingCleaner'])->name('storeLaporanGroomingCleaner');
        Route::delete('/Laporan-Grooming/{id_lg}',[GroomingController::class, 'destroyLaporanGroomingCleaner'])->name('destroyLaporanGroomingCleaner');

    });


    // Routes for supervisor
    Route::middleware(['spv'])->prefix('Supervisor')->group(function () {
        // Route::get('/Laporan-Grooming', GroomingLivewire::class)->name('showTanggapanGrooming');
        Route::get('/Laporan-Grooming', [GroomingController::class, 'showTanggapanGroomingSupervisor'])->name('showTanggapanGrooming');
        Route::post('/Laporan-Grooming', [GroomingController::class, 'inputTanggapanGroomingSupervisor'])->name('inputTanggapanGrooming');
    });

    // Routes for admin
    Route::middleware(['admin'])->prefix('Admin')->group(function () {

        Route::get('/user', [ProfileController::class, 'index'])->name('user.index');
        Route::get('/user/create', [ProfileController::class, 'create'])->name('user.create');
        Route::post('/user/create', [ProfileController::class, 'store'])->name('user.store');
        Route::get('/user/edit/{id_users}', [ProfileController::class, 'edit'])->name('user.edit');
        Route::put('/user/update/{id_users}', [ProfileController::class, 'update'])->name('user.update');
        Route::delete('/user/{id_users}', [ProfileController::class, 'destroy'])->name('user.destroy');

        Route::resource('Sop', sopController::class)->names([
            'index' => 'sop.index',
            'create' => 'sop.create',
            'store' => 'sop.store',
            'show' => 'sop.show',
            'edit' => 'sop.edit',
            'update' => 'sop.update',
            'destroy' => 'sop.destroy',
        ]);

        Route::resource('Area', areaController::class)->names([
            'index' => 'area.index',
            'create' => 'area.create',
            'store' => 'area.store',
            'show' => 'area.show',
            'edit' => 'area.edit',
            'update' => 'area.update',
            'destroy' => 'area.destroy',
        ]);

        Route::resource('Laporan-Grooming', GroomingController::class)->names([
            'index' => 'laporan-grooming.index',
            'create' => 'laporan-grooming.create',
            'store' => 'laporan-grooming.store',
            'show' => 'laporan-grooming.show',
            'edit' => 'laporan-grooming.edit',
            'update' => 'laporan-grooming.update',
            'destroy' => 'laporan-grooming.destroy',
        ]);

        Route::resource('Laporan-PJKP', PjkpController::class)->names([
            'index' => 'laporan-pjkp.index',
            'create' => 'laporan-pjkp.create',
            'store' => 'laporan-pjkp.store',
            'show' => 'laporan-pjkp.show',
            'edit' => 'laporan-pjkp.edit',
            'update' => 'laporan-pjkp.update',
            'destroy' => 'laporan-pjkp.destroy',
        ]);
    });
});

require __DIR__.'/auth.php';
