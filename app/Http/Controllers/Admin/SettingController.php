<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    protected SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    public function index(): View
    {
        $setting = \App\Models\AbsensiSetting::first();

        return view('admin.settings.index', compact('setting'));
    }

    public function toggle(): RedirectResponse
    {
        $this->settingService->toggle();

        return redirect()
            ->back()
            ->with('success', 'Status absensi berhasil diperbarui.');
    }
}
