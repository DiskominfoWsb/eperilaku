<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PegawaiResource;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class PegawaiDataController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $pegawai = Pegawai::where('nip', $request->nip)->with('golongan')->with('user')->first();
        return new PegawaiResource($pegawai);
    }
}
