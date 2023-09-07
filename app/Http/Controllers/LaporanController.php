<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function perAnak()
    {
        return view('laporan.per_anak');
    }

    public function perBulan()
    {
        return view('laporan.per_bulan');
    }
}
