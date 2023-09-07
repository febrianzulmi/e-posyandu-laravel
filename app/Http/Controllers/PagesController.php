<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagesController extends Controller
{
    public function getIndex()
    {
        $anak = DB::table('anak')->count();
        $perkembangan_anak = DB::table('perkembangan_anak')->count();

        return view('pages.index', compact('anak', 'perkembangan_anak'));
    }
}
