<?php

namespace App\Http\Controllers;

use App\Models\Anak;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\AnakRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class AnakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('anak.index');
    }

    public function datatableJson()
    {
        $data = Anak::query();

        return DataTables::of($data)
                            ->addIndexColumn()
                            ->editColumn('tgl_lahir', function($data) {
                                return $data->created_at->format('d/m/Y');
                            })
                            ->editColumn('usia', function($data) {
                                return $data->usia.' '.$data->satuan_usia;
                            })
                            ->addColumn('aksi', function($data) {
                                return '
                                    <a href="'.route('anak.edit', $data->id).'" class="btn btn-sm btn-warning rounded-0">Edit</a>
                                    <a href="'.route('anak.edit.akun', $data->id).'" class="btn btn-sm btn-warning rounded-0">Edit Akun</a>
                                    <a href="'.route('anak.show', $data->id).'" class="btn btn-sm btn-info rounded-0">Detail</a>
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
        return view('anak.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnakRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = User::create([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => bcrypt($request->password)
            ]);

            $anak_request = $request->except('_token', 'username', 'password');
            $anak_request['user_id'] = $user->id;

            Anak::create($anak_request);

            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();

            return redirect()->back()->withInput($request->all())->with('error', 'Data gagal disimpan');
        }

        return redirect()->route('anak.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($anak)
    {
        $anak = Anak::with('user')->findOrFail($anak);

        return view('anak.show', compact('anak'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($anak)
    {
        $anak = Anak::with('user')->findOrFail($anak);

        return view('anak.edit', compact('anak'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Anak $anak)
    {
        $anak_request = $request->except('_token', '_method');
        $anak->update($anak_request);

        return redirect()->route('anak.index')->with('success', 'Data berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Anak $anak)
    {
        DB::beginTransaction();

        try {
            $anak->user->delete();

            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Data gagal dihapus');
        }

        return redirect()->route('anak.index')->with('success', 'Data berhasil dihapus');
    }

    public function editAkun($anak)
    {
        $anak = Anak::with('user')->findOrFail($anak);

        return view('anak.edit_akun', compact('anak'));
    }

    public function updateAkun(AnakRequest $request, Anak $anak)
    {
        $password = $anak->user->password;

        if($request->password) {
            $password = $request->password;
        }

        $anak->user->update([
            'password' => bcrypt($password)
        ]);

        return redirect()->route('anak.index')->with('success', 'Data berhasil disimpan');
    }
}
