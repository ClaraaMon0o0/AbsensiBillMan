<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Absensi;
use App\Models\AbsensiSetting;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = now()->toDateString();

        $totalPetugas = User::where('role', 'petugas')->count();

        $totalAbsensiHariIni = Absensi::whereDate('tanggal', $today)->count();

        $totalHadir = Absensi::where('tanggal', $today)
            ->where('status', 'Hadir')
            ->count();

        $totalIzin = Absensi::where('tanggal', $today)
            ->where('status', 'Izin')
            ->count();

        $totalSakit = Absensi::where('tanggal', $today)
            ->where('status', 'Sakit')
            ->count();

        $totalCuti = Absensi::where('tanggal', $today)
            ->where('status', 'Cuti')
            ->count();

        $isOpen = AbsensiSetting::first()?->is_open ?? false;

        $belumAbsen = $totalPetugas - $totalAbsensiHariIni;


        return view('admin.dashboard', compact(
            'totalPetugas',
            'totalAbsensiHariIni',
            'totalHadir',
            'totalIzin',
            'totalSakit',
            'totalCuti',
            'isOpen',
            'belumAbsen'
        ));
    }
}