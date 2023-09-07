<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use Illuminate\Http\Request;
use App\Models\PerkembanganAnak;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class PerkembanganAnakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('perkembangan_anak.index');
    }

    public function datatableJson(Request $request)
    {
        $data = PerkembanganAnak::with('anak')->where(function($query) use($request) {
            if($request->month_filter) {
                $month_filter = $request->month_filter;
                $month_filter = explode('-', $month_filter);

                $query->whereYear('tgl_penimbangan', $month_filter[0])
                        ->whereMonth('tgl_penimbangan', $month_filter[1]);
            }

            if(Gate::allows('isUser')) {
                $query->where('anak_id', '=', auth()->user()->anak->id);
            }
        });

        return DataTables::of($data)
                            ->addIndexColumn()
                            ->editColumn('tgl_penimbangan', function($data) {
                                return $data->tgl_penimbangan->format('d/m/Y');
                            })
                            ->editColumn('berat_badan', function($data) {
                                return $data->berat_badan.' KG';
                            })
                            ->editColumn('tinggi_badan', function($data) {
                                return $data->tinggi_badan.' CM';
                            })
                            ->addColumn('aksi', function($data) {
                                return '
                                    <a href="'.route('perkembangan-anak.edit', $data->id).'" class="btn btn-sm btn-warning rounded-0">Edit</a>
                                    <button type="button" data-id="'.$data->id.'" class="btn btn-sm btn-danger rounded-0 btn-delete">Hapus</button>
                                ';
                            })
                            ->rawColumns(['aksi'])
                            ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $anak = Anak::orderBy('nama')->get();

        return view('perkembangan_anak.create', compact('anak'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        PerkembanganAnak::create($request->except('_token'));

        return redirect()->route('perkembangan-anak.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PerkembanganAnak $perkembangan_anak)
    {
        $anak = Anak::orderBy('nama')->get();

        return view('perkembangan_anak.edit', compact('perkembangan_anak', 'anak'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PerkembanganAnak $perkembangan_anak)
    {
        $perkembangan_anak->update($request->except('_token', '_method'));

        return redirect()->route('perkembangan-anak.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(PerkembanganAnak $perkembangan_anak)
    {
        $perkembangan_anak->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ], 200);
    }
}
