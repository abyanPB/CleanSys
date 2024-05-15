<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SopController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroomingController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PjkpController;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

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
//     return view('index');
// });

//Route for Guest
Route::resource('Guest', GuestController::class)->names([
    'index' => 'Guest.index',
    'create' => 'Guest.create',
    'store' => 'Guest.store',
    'show' => 'Guest.show',
    'edit' => 'Guest.edit',
    'update' => 'Guest.update',
    'destroy' => 'Guest.destroy',
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/Dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/Defaultpass', [DashboardController::class, 'defaultPass'])->name('defaultpass');

    //Route Ubah Profile Semua Role
    Route::get('/Profile', [ProfileController::class, 'viewProfile'])->name('showProfile');
    Route::put('/Profile/Update', [ProfileController::class, 'changeProfile'])->name('changeProfile');

    // Routes for cleaner
    Route::middleware(['cleaner'])->prefix('Cleaner')->group(function () {
        Route::get('/Sop',[SopController::class, 'showSopCleaner'])->name('showSopCleaner');

        //Routes for Grooming
        Route::get('/Laporan-Grooming/Index',[GroomingController::class, 'indexGroomingDailyReportCleaner'])->name('showLaporanGroomingCleaner');
        Route::get('/Laporan-Grooming/Create',[GroomingController::class, 'createGroomingDailyReportCleaner'])->name('createLaporanGroomingCleaner');
        Route::post('/Laporan-Grooming/Create',[GroomingController::class, 'storeGroomingDailyReportCleaner'])->name('storeLaporanGroomingCleaner');
        Route::get('/Laporan-Grooming/Edit/{id_lg}',[GroomingController::class, 'editGroomingDailyReportCleaner'])->name('editLaporanGroomingCleaner');
        Route::put('/Laporan-Grooming/Update/{id_lg}',[GroomingController::class, 'updateGroomingDailyReportCleaner'])->name('updateLaporanGroomingCleaner');
        Route::delete('/Laporan-Grooming/{id_lg}',[GroomingController::class, 'destroyGroomingDailyReportCleaner'])->name('destroyLaporanGroomingCleaner');

        //Routes for PJKP
        Route::get('/Laporan-PJKP/Index',[PjkpController::class, 'indexPjkpDailyReportCleaner'])->name('showLaporanPjkpCleaner');
        Route::get('/Laporan-PJKP/Create',[PjkpController::class, 'createPjkpDailyReportCleaner'])->name('createLaporanPjkpCleaner');
        Route::post('/Laporan-PJKP/Create',[PjkpController::class, 'storePjkpDailyReportCleaner'])->name('storeLaporanPjkpCleaner');
        Route::get('/Laporan-PJKP/Edit/{id_lp}',[PjkpController::class, 'editPjkpDailyReportCleaner'])->name('editLaporanPjkpCleaner');
        Route::put('/Laporan-PJKP/Update/{id_lp}',[PjkpController::class, 'updatePjkpDailyReportCleaner'])->name('updateLaporanPjkpCleaner');
        Route::delete('/Laporan-PJKP/{id_lp}',[PjkpController::class, 'destroyPjkpDailyReportCleaner'])->name('destroyLaporanPjkpCleaner');
    });


    // Routes for supervisor
    Route::middleware(['spv'])->prefix('Supervisor')->group(function () {
        // Route::get('/Laporan-Grooming', GroomingLivewire::class)->name('showTanggapanGrooming');
        //Route for Grooming
        Route::get('/Laporan-Grooming', [GroomingController::class, 'indexGroomingResponseSupervisor'])->name('showTanggapanGrooming');
        Route::post('/Laporan-Grooming', [GroomingController::class, 'storeGroomingResponseSupervisor'])->name('inputTanggapanGrooming');

        //Route for Pjkp
        Route::get('/Laporan-PJKP', [PjkpController::class, 'indexPjkpResponseSupervisor'])->name('showTanggapanPjkp');
        Route::post('/Laporan-PJKP', [PjkpController::class, 'storePjkpResponseSupervisor'])->name('inputTanggapanPjkp');
    });

    // Routes for admin
    Route::middleware(['admin'])->prefix('Admin')->group(function () {

        Route::get('/User/Index', [ProfileController::class, 'index'])->name('user.index');
        Route::get('/User/Create', [ProfileController::class, 'create'])->name('user.create');
        Route::post('/User/Create', [ProfileController::class, 'store'])->name('user.store');
        Route::get('/User/Edit/{id_users}', [ProfileController::class, 'edit'])->name('user.edit');
        Route::put('/User/Update/{id_users}', [ProfileController::class, 'update'])->name('user.update');
        Route::delete('/User/{id_users}', [ProfileController::class, 'destroy'])->name('user.destroy');

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

        Route::post('/Laporan-Grooming/Cetakpdf',[GroomingController::class, 'generatePdf'])->name('cetakpdf');
        Route::resource('Laporan-Grooming', GroomingController::class)->names([
            'index' => 'laporan-grooming.index',
            'destroy' => 'laporan-grooming.destroy',
        ]);

        //Route Livewire Controller
        // Route::get('/Laporan-PJKP', PjkpLivewire::class)->name('showLaporanPJKP');
        // Route::get('/Laporan-PJKP/Create', PjkpCreate::class)->name('createLaporanPJKP');

        Route::resource('Laporan-PJKP', PjkpController::class)->names([
            'index' => 'laporan-pjkp.index',
            'destroy' => 'laporan-pjkp.destroy',
        ]);
    });
})->middleware(['verified']);

require __DIR__.'/auth.php';
