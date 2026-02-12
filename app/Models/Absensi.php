<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';

    // 🔥 WAJIB KARENA PAKAI UUID
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'user_id',
        'tanggal',
        'kegiatan',
        'keterangan',
        'status',
        'foto_path',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    // 🔥 AUTO GENERATE UUID
    protected static function booted()
    {
        static::creating(function ($absensi) {
            if (!$absensi->getKey()) {
                $absensi->{$absensi->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    // 🔥 RELASI KE USER
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
