<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use App\Models\AbsensiSetting;


class AbsensiController extends Controller
{
    public function index(Request $request): View
{
    $query = Absensi::where('user_id', auth()->id());

    // Filter tanggal
    if ($request->filled('tanggal')) {
        $query->whereDate('tanggal', $request->tanggal);
    }

    // Filter status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    $absensis = $query
        ->latest()
        ->paginate(10);

    return view('petugas.absensi.index', compact('absensis'));
}


    public function create(): View
    {
        return view('petugas.absensi.create');
    }

    public function store(Request $request)
    {
            // 🔥 CEK STATUS ABSENSI (DITUTUP / DIBUKA)
        $setting = AbsensiSetting::first();

        if (!$setting || !$setting->is_open) {
            return back()->with('error', 'Absensi sedang ditutup oleh admin.');
        }

        $request->validate([
            'kegiatan' => 'required|integer',
            'keterangan' => 'required|string',
            'status' => 'required|string',
            'foto_base64' => 'required',
        ]);

        $now = now(); // ⬅ ambil waktu lengkap (tanggal + jam)
        $today = $now->toDateString(); // ⬅ tetap dipakai untuk cek 1x per hari

        // Cek sudah absen hari ini (tanpa lihat jam)
        if (Absensi::where('user_id', auth()->id())
            ->whereDate('tanggal', $today) // ⬅ DIUBAH
            ->exists()) {
            return back()->with('error', 'Anda sudah absen hari ini.');
        }

        // Ambil data base64
        $image = $request->foto_base64;

        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);

        $imageName = 'absensi/' . $today . '/' . uniqid() . '.jpg';

        Storage::disk('public')->put($imageName, base64_decode($image));

        Absensi::create([
            'user_id' => auth()->id(),
            'tanggal' => $now, // ⬅ DIUBAH supaya simpan jam juga
            'kegiatan' => $request->kegiatan,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'foto_path' => $imageName,
        ]);

        return redirect()
            ->route('petugas.absensi.index')
            ->with('success', 'Absensi berhasil disimpan.');
    }
}