<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

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
            'keterangan' => 'required|string',
            'status' => 'required|string',
            'foto_base64' => 'required', // DIUBAH
        ]);

        $today = now()->toDateString();

        // Cek sudah absen hari ini
        if (Absensi::where('user_id', auth()->id())
            ->where('tanggal', $today)
            ->exists()) {
            return back()->with('error', 'Anda sudah absen hari ini.');
        }

        // Ambil data base64
        $image = $request->foto_base64;

        // Hilangkan prefix base64
        $image = str_replace('data:image/jpeg;base64,', '', $image);
        $image = str_replace(' ', '+', $image);

        $imageName = 'absensi/' . $today . '/' . uniqid() . '.jpg';

        Storage::disk('public')->put($imageName, base64_decode($image));

        Absensi::create([
            'user_id' => auth()->id(),
            'tanggal' => $today,
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
