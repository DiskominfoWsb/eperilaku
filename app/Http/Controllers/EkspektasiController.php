<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateEkspektasiRequest;
use App\Models\Ekspektasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EkspektasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function data_ekspektasi_jenis($jenis, $skp)
    {
        $ekspektasi = Ekspektasi::where('jenis', $jenis)->where('skp_id', $skp)->get();

        return response()->json($ekspektasi);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreEkspektasiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'jenis' => 'required|string',
            'expektasi' => 'min:5',
        ])->validateWithBag('storeEkspektasi');

        Ekspektasi::create([
            'skp_id' => $request->skpid,
            'jenis' => $request->jenis,
            'ekspektasi_atasan' => $request->expektasi,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ekspektasi  $ekspektasi
     * @return \Illuminate\Http\Response
     */
    public function show(Ekspektasi $ekspektasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ekspektasi  $ekspektasi
     * @return \Illuminate\Http\Response
     */
    public function edit(Ekspektasi $ekspektasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEkspektasiRequest  $request
     * @param  \App\Models\Ekspektasi  $ekspektasi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEkspektasiRequest $request, Ekspektasi $ekspektasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ekspektasi  $ekspektasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ekspektasi $ekspektasi)
    {
        $ekspektasi->delete();

        return redirect()->back();
    }
}
