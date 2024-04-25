<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkpRequest;
use App\Http\Requests\UpdateSkpRequest;
use App\Models\Kinerja;
use App\Models\Pegawai;
use App\Models\Skp;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SkpController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Skp::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $limit = 20;
        $user = Auth::user()->with('skp')->first();
        $countPegawai = Pegawai::where('user_id', Auth()->id())->count();
        $isActive = Skp::where('user_id', Auth()->id())->where('status', 'draft')->count();
        $master = Skp::where('user_id', Auth::id())->with('pegawai')->with('atasan')->paginate($limit);
        $master_dinilai = Skp::where('atasan_id', Auth::user()->pegawai->id)->with('pegawai')->with('atasan')->paginate($limit);

        //        dd($master_dinilai);
        return inertia()->render('Skp/Index', [
            'master' => $master,
            'masterDinilai' => $master_dinilai,
            'user' => $user,
            'countPegawai' => $countPegawai,
            'isActive' => $isActive,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $isactive = Skp::where('status', 'draft')->count();
        $skp = Skp::where('status', 'draft')->where('user_id', Auth()->id())->with('atasan')->with('pegawai')->get();

        return inertia()->render('Skp/Create', [
            'isactive' => $isactive,
            'skp' => $skp,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSkpRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSkpRequest $request)
    {
        $pegawai = Pegawai::where('user_id', Auth::user()->id)->first();

        Skp::create([
            'skp_mulai' => request('mulai'),
            'skp_selesai' => request('selesai'),
            'pegawai_id' => $pegawai->id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('status', 'Berhasil menambahkan skp baru');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Skp  $skp
     * @return \Inertia\Response
     */
    public function show(Skp $skp)
    {
        $months = ['JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI', 'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'];

        $is_penilai = $skp->atasan_id == Auth::user()->pegawai->id;

        $dataskp = Skp::where('id', $skp->id)
            ->with('pegawai')
            ->with('atasan')
            ->with('kinerja')
            ->with('indikator')
            ->with('perilaku')
            ->with('ekspektasi')
            ->get();
        $newFormat = $dataskp->map(function ($item) use ($months) {
            return [
                'id' => $item->id,
                'mulai' => Carbon::parse($item->skp_mulai)->format('j') . ' ' . $months[Carbon::parse($item->skp_mulai)->month - 1],
                'selesai' => Carbon::parse($item->skp_selesai)->format('j') . ' ' . $months[Carbon::parse($item->skp_selesai)->month - 1],
                'tahun' => Carbon::parse($item->skp_selesai)->format('Y'),
                'pegawai' => Pegawai::where('id', '=', $item->pegawai_id)->with('golongan')->first(),
                'atasan' => Pegawai::where('id', '=', $item->atasan_id)->with('golongan')->first(),
                'ekspektasi' => $item->ekspektasi,
                'utama' => Kinerja::where('skp_id', $item->id)->where('jenis', '=', 'UTAMA')->get(),
                'utama_count' => $item->kinerja->where('jenis', '=', 'UTAMA')->count(),
                'tambahan' => Kinerja::where('skp_id', $item->id)->where('jenis', '=', 'TAMBAHAN')->get(),
                'tambahan_count' => $item->kinerja->where('jenis', '=', 'TAMBAHAN')->count(),
            ];
        });

        return inertia()->render('Skp/Show', [
            'skp' => $newFormat->first(),
            'isPenilai' => $is_penilai,
        ]);
    }

    public function monitor(Request $request)
    {
        return inertia()->render('Skp/Monitor');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Skp  $skp
     * @return \Illuminate\Http\Response
     */
    public function edit(Skp $skp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSkpRequest  $request
     * @param  \App\Models\Skp  $skp
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSkpRequest $request, Skp $skp)
    {
        if ($request->update_atasan) {
            $skp->atasan_id = $request->atasan;
        } else {
            $skp->skp_mulai = $request->mulai;
            $skp->skp_selesai = $request->selesai;
        }
        $skp->save();

        return redirect()->back()->with('status', 'Berhasil memperbarui skp');
    }

    public function update_atasan(Request $request)
    {
        $skp = Skp::where('id', $request->skp)->first();
        if ($skp->pegawai_id === $request->atasan) {
            return response()->json(['status' => false, 'message' => 'nip pegawai dan atasan tidak boleh sama']);
        }

        $skp->atasan_id = $request->atasan;
        $skp->save();

        return response()->json(['status' => true, 'message' => 'Berhasil memperbarui skp']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Skp  $skp
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Skp $skp)
    {
        $skp->delete();

        return redirect()->back()->with('status', 'Berhasil menghapus skp');
    }
}
