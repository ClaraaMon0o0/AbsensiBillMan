<?php

namespace App\Services;

use App\Models\AbsensiSetting;

class SettingService
{
    public function toggle(): AbsensiSetting
    {
        $setting = AbsensiSetting::first();

        if (!$setting) {
            $setting = AbsensiSetting::create([
                'is_open' => true,
                'opened_at' => now(),
            ]);
            return $setting;
        }

        $setting->is_open = !$setting->is_open;

        if ($setting->is_open) {
            $setting->opened_at = now();
            $setting->closed_at = null;
        } else {
            $setting->closed_at = now();
        }

        $setting->save();

        return $setting;
    }

    public function isOpen(): bool
    {
        return AbsensiSetting::first()?->is_open ?? false;
    }
}
