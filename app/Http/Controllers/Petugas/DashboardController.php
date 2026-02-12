<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $today = now()->toDateString();

        $userId = auth()->id();

        $sudahAbsen = Absensi::where('user_id', $userId)
            ->where('tanggal', $today)
            ->exists();

        $totalAbsensi = Absensi::where('user_id', $userId)->count();

        $absensiTerakhir = Absensi::where('user_id', $userId)
            ->latest()
            ->first();

        return view('petugas.dashboard', compact(
            'sudahAbsen',
            'totalAbsensi',
            'absensiTerakhir'
        ));
    }
}
