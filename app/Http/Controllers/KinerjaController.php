<?php

namespace App\Http\Controllers;

use App\Models\Kinerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KinerjaController extends Controller
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
     * @param  \App\Http\Requests\StoreKinerjaRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'jenis' => 'required:in:UTAMA,TAMBAHAN',
            'rencana_intervensi' => 'required',
            'rencana' => 'required',
            'aspek' => 'required',
            'indikator' => 'required|string',
            'target' => 'required',
        ], [
            'rencana_intervensi.required' => 'rencana hasil kerja atasan yang diintervensi wajib diisi.',
            'rencana.required' => 'rencana hasil kerja wajib diisi.',
        ])->validateWithBag('createNewKinerja');

        Kinerja::create([
            'jenis' => $request->jenis,
            'skp_id' => $request->skp_id,
            'rencana_intervensi' => $request->rencana_intervensi,
            'rencana' => $request->rencana,
            'aspek' => $request->aspek,
            'indikator' => $request->indikator,
            'target' => $request->target,
        ]);

        return redirect()->back()->with('message', 'Berhasil menambahkan data kinerja '.$request->jenis);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kinerja  $kinerja
     * @return \Illuminate\Http\Response
     */
    public function show(Kinerja $kinerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kinerja  $kinerja
     * @return \Illuminate\Http\Response
     */
    public function edit(Kinerja $kinerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKinerjaRequest  $request
     * @param  \App\Models\Kinerja  $kinerja
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Kinerja $kinerja)
    {
//        dd($kinerja);
        $kinerja->rencana_intervensi = $request->rencana_intervensi;
        $kinerja->rencana = $request->rencana;
        $kinerja->aspek = $request->aspek;
        $kinerja->indikator = $request->indikator;
        $kinerja->target = $request->target;
        $kinerja->save();

        return redirect()->back()->with('message', 'Berhasil merubah kinerja');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kinerja  $kinerja
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Kinerja $kinerja)
    {
        $kinerja->delete();

        return redirect()->back()->with('message', 'Berhasih di hapus');
    }
}
