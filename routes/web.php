<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AbsensiController as AdminAbsensi;
use App\Http\Controllers\Admin\SettingController;

use App\Http\Controllers\Petugas\DashboardController as PetugasDashboard;
use App\Http\Controllers\Petugas\AbsensiController as PetugasAbsensi;

/*
|--------------------------------------------------------------------------
| Root Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| After Login Redirect (Role Based)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/redirect', function () {

    return match (auth()->user()->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'petugas' => redirect()->route('petugas.dashboard'),
        default   => redirect()->route('login'),
    };
})->name('redirect');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboard::class, 'index'])
            ->name('dashboard');

        Route::resource('users', UserController::class);

        Route::get('/absensi', [AdminAbsensi::class, 'index'])
            ->name('absensi');

        Route::get('/absensi/export', [AdminAbsensi::class, 'export'])
            ->name('absensi.export');

        Route::get('/settings', [SettingController::class, 'index'])
            ->name('settings');

        Route::post('/settings/toggle', [SettingController::class, 'toggle'])
            ->name('settings.toggle');
    });

/*
|--------------------------------------------------------------------------
| PETUGAS ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:petugas'])
    ->prefix('petugas')
    ->name('petugas.')
    ->group(function () {

        Route::get('/dashboard', [PetugasDashboard::class, 'index'])
            ->name('dashboard');

        Route::get('/absensi', [PetugasAbsensi::class, 'index'])
            ->name('absensi.index');

        Route::get('/absensi/create', [PetugasAbsensi::class, 'create'])
            ->name('absensi.create');

        Route::post('/absensi', [PetugasAbsensi::class, 'store'])
            ->name('absensi.store');
    });

require __DIR__.'/auth.php';
