<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\RfidTemp;
use App\Models\SuhuTemp;
use App\Models\TBTemp;
use App\Models\BBTemp;

class PagesController extends Controller
{
    public function getIndex()
    {
        $anak = DB::table('anak')->count();
        $perkembangan_anak = DB::table('perkembangan_anak')->count();

        return view('pages.index', compact('anak', 'perkembangan_anak'));
    }
    // relatime
    public function nokartu()
    {
        $dataRFID = RfidTemp::all();
        $cekRFID = RfidTemp::all()->toArray();

        return view('perkembangan_anak.nokartu', compact('dataRFID', 'cekRFID'));
    }
    // realtime
    public function tinggi()
    {
        $dataTB = TBTemp::all();
        $cekTB = TBTemp::all()->toArray();

        return view('perkembangan_anak.tinggi', compact('dataTB', 'cekTB'));
    }
    // realtime
    public function berat()
    {
        $dataBB = BBTemp::all();
        $cekBB = BBTemp::all()->toArray();

        return view('perkembangan_anak.berat', compact('dataBB', 'cekBB'));
    }
    // relatime
    public function suhu()
    {
        $dataSuhu = SuhuTemp::all();
        $cekSuhu = SuhuTemp::all()->toArray();

        return view('perkembangan_anak.suhu', compact('dataSuhu', 'cekSuhu'));
    }

    // method dari arduino
    public function temp_rfid($id)
    {

        $delete = RfidTemp::truncate();

        $insert = RfidTemp::create([
            'uid' => $id,
        ]);

        return 'Kartu Masuk';
    }

    public function temp_suhu($id)
    {

        $delete = SuhuTemp::truncate();

        $insert = SuhuTemp::create([
            'suhu' => $id,
        ]);

        return 'Suhu Masuk';
    }
    public function temp_tinggi($id)
    {

        $delete = TBTemp::truncate();

        $insert = TBTemp::create([
            'tb' => $id,
        ]);

        return 'Tinggi Masuk';
    }
    public function temp_berat($id)
    {

        $delete = BBTemp::truncate();

        $insert = BBTemp::create([
            'bb' => $id,
        ]);

        return 'Berat Masuk';
    }
}
