<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Exports\AbsensiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AbsensiController extends Controller
{
    public function index(Request $request): View
    {
        $query = Absensi::with('user')->latest();

        if ($request->filled('tanggal')) {
            $query->where('tanggal', $request->tanggal);
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $absensis = $query->paginate(10);

        return view('admin.absensi.index', compact('absensis'));
    }

    public function export(Request $request)
    {
    $tanggal = $request->tanggal;

    return Excel::download(
        new AbsensiExport($tanggal),
        'laporan-absensi.xlsx'
    );
    }

}
