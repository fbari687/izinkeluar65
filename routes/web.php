<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardGuruController;
use App\Http\Controllers\DashboardJadwalPelajaran;
use App\Http\Controllers\DashboardJurusanController;
use App\Http\Controllers\DashboardKelasController;
use App\Http\Controllers\DashboardMataPelajaran;
use App\Http\Controllers\DashboardReportController;
use App\Http\Controllers\DashboardSiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IzinController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Models\Siswa;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Profiler\Profile;

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

Route::get('/login', [AuthController::class, 'index'])->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->middleware('guest');

Route::get('/', [AuthController::class, 'home']);
Route::get('/admin/jadwal/getguru', [DashboardJadwalPelajaran::class, 'getGuru']);


Route::middleware(['auth'])->group(function () {
    Route::get('/profile/changepass', fn () => view('main.siswa.changepass'));
    Route::get('/peraturan', fn () => view('main.siswa.peraturan'));
    Route::get('/about', fn () => view('main.siswa.about'));
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/profile/{user}', [ProfileController::class, 'updateImage']);
});

Route::middleware(['siswa'])->group(function () {
    Route::get('/siswa', [HomeController::class, 'siswa']);
    Route::get('/siswa/{id}/detail', [SiswaController::class, 'detail']);
    Route::get('/siswa/form', [SiswaController::class, 'formPerizinan']);
    Route::post('/siswa/form', [IzinController::class, 'store']);
    Route::get('/siswa/profile', [SiswaController::class, 'profile']);
    Route::get('/siswa/riwayat', [SiswaController::class, 'riwayat']);
});

Route::middleware(['guru'])->group(function () {
    Route::get('/guru', [GuruController::class, 'home']);
    Route::get('/guru/izin/{id}', [GuruController::class, 'detailIzin']);
    Route::post('/guru/{id}/izin', [GuruController::class, 'givePermission']);
    Route::get('/guru/riwayat', [GuruController::class, 'riwayat']);
    Route::get('/guru/riwayat/{id}', [GuruController::class, 'detailRiwayat']);
    Route::get('/guru/profile', fn () => view('main.guru.profile'));
});

Route::middleware(['admin'])->group(function () {
    Route::get('/admin', fn () => view('main.admin.home'));
    Route::get('/admin/profile', fn () => view('main.admin.profile'));
    Route::put('/admin/profile/change/{user}', [ProfileController::class, 'updateNama']);
    // CMS AKUN SISWA
    Route::resource('/admin/siswa', DashboardSiswaController::class);
    // CMS AKUN GURU
    Route::resource('/admin/guru', DashboardGuruController::class);

    // CMS MAPEL
    Route::resource('/admin/mapel', DashboardMataPelajaran::class);

    // CMS KELAS
    Route::resource('/admin/kelas', DashboardKelasController::class);

    // CMS JURUSAN
    Route::resource('/admin/jurusan', DashboardJurusanController::class);

    // CMS JADWAL PELAJARAN
    Route::get('/admin/jadwal', [DashboardJadwalPelajaran::class, 'index']);
    Route::get('/admin/jadwal/{id}', [DashboardJadwalPelajaran::class, 'detail']);
    Route::get('/admin/jadwal/{id}/{hari}', [DashboardJadwalPelajaran::class, 'edit']);
    Route::post('/admin/jadwal', [DashboardJadwalPelajaran::class, 'store']);
    // CMS REPORTS
    Route::get('/admin/reports', [DashboardReportController::class, 'index']);
    Route::get('/admin/reports/{id}', [DashboardReportController::class, 'detail']);
});
