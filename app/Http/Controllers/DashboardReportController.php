<?php

namespace App\Http\Controllers;

use App\Models\PerizinanSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardReportController extends Controller
{
    public function index()
    {
        return view('main.admin.reports.index', [
            'BanyakPerizinanSiswa' => PerizinanSiswa::orderBy('created_at', 'desc')->get()
        ]);
    }

    public function detail(string $id)
    {
        $perizinanSiswa = PerizinanSiswa::where("id", $id)->first();
        $today = Carbon::parse($perizinanSiswa->tanggal)->format('l');
        return view('main.admin.reports.detail', [
            'perizinanSiswa' => $perizinanSiswa,
            'day' => $today
        ]);
    }
}
