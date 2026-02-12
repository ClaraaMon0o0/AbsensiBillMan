<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AbsensiController extends Controller
{
    public function index(): View
    {
        $absensis = Absensi::where('user_id', auth()->id())
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
        $request->validate([
            'kegiatan' => 'required|integer',
            'keterangan' => 'nullable|string',
            'status' => 'required|string',
            'foto' => 'required|image|max:2048',
        ]);

        $today = now()->toDateString();

        // Cek sudah absen hari ini
        if (Absensi::where('user_id', auth()->id())
            ->where('tanggal', $today)
            ->exists()) {
            return back()->with('error', 'Anda sudah absen hari ini.');
        }

        $path = $request->file('foto')->store(
            'absensi/' . $today,
            'public'
        );

        Absensi::create([
            'user_id' => auth()->id(),
            'tanggal' => $today,
            'kegiatan' => $request->kegiatan,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
            'foto_path' => $path,
        ]);

        return redirect()
            ->route('petugas.absensi.index')
            ->with('success', 'Absensi berhasil disimpan.');
    }
}
