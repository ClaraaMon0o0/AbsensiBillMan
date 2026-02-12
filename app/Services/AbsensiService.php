<?php

namespace App\Services;

use App\Models\Absensi;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AbsensiService
{
    public function store(array $data)
    {
        $user = auth()->user();
        $today = now()->toDateString();

        // Validasi 1x per hari
        if (Absensi::where('user_id', $user->id)
            ->where('tanggal', $today)
            ->exists()) {
            throw new \Exception('Anda sudah melakukan absensi hari ini.');
        }

        // Simpan foto
        $path = $data['foto']->store(
            "absensi/{$today}",
            'public'
        );

        return Absensi::create([
            'id' => Str::uuid(),
            'user_id' => $user->id,
            'tanggal' => $today,
            'kegiatan' => $data['kegiatan'],
            'keterangan' => $data['keterangan'],
            'status' => $data['status'],
            'foto_path' => $path,
        ]);
    }
}
