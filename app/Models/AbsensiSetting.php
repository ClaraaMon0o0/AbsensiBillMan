<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbsensiSetting extends Model
{
    protected $table = 'absensi_settings';

    protected $fillable = [
        'is_open',
        'opened_at',
        'closed_at',
    ];

    protected $casts = [
        'is_open'   => 'boolean',
        'opened_at' => 'datetime',
        'closed_at' => 'datetime',
    ];
}
