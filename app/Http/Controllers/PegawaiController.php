<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use App\Models\Pegawai;
use App\Models\Skp;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules;
use Inertia\Inertia;

class PegawaiController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Pegawai::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $pegawai = Pegawai::query();

        return  Inertia::render('Pegawai/Index', [
            'master' => $pegawai->with('user')->paginate(20),
        ]);
    }

    public function getPegawai(Request $request)
    {
        if ($request->nip == $request->user()->pegawai->nip)
            return response()->json();

        $pegawai = Pegawai::where('nip', $request->nip)->get();



        return response()->json($pegawai);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        return inertia()->render('Pegawai/Create', [
            'golongan' => Golongan::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePegawaiRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'nip' => 'required|string|min:18|max:18|unique:pegawai|unique:users,username',
            'nama' => 'required|string|max:255',
            'gelar_depan' => 'required|string|max:255',
            'gelar_belakang' => 'required|string|max:255',
            't_lahir' => 'required|string|max:255',
            'tgl_lahir' => 'required|string|max:255',
            'jns_kelamin' => 'required|in:L,P',
            'instansi' => 'required|string',
            'kode_gol' => 'required|not_in:X',
            'jabatan' => 'required|string',
            'no_telp' => 'required',
            'email' => 'required|email|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], [
            't_lahir' => 'Tempat Lahir wajib diisi.',
            'tgl_lahir' => 'Tanggal Lahir bukan tanggal yang valid.',
            'jns_kelamin' => 'Jenis Kelamin yang dipilih tidak valid.',
            'no_telp' => 'No Telpon wajib diisi.',
            'kode_gol' => 'Golongan yang dipilih tidak valid.',
        ])->validateWithBag('createNewPegawai');

        $user = User::create([
            'email' => $request->email,
            'name' => $request->nama,
            'username' => $request->nip,
            'password' => Hash::make($request->password),
        ]);

        $userId = $user->id;

        $pegawai = Pegawai::create([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'gelar_depan' => $request->gelar_depan,
            'gelar_belakang' => $request->gelar_belakang,
            't_lahir' => $request->t_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jns_kelamin' => $request->jns_kelamin,
            'golongan_id' => $request->kode_gol,
            'no_telp' => $request->no_telp,
            'jabatan' => $request->jabatan,
            'instansi' => $request->instansi,
            'user_id' => $userId,
        ]);

        if (!$pegawai) {
            $user->delete();
            $pegawai->delete();

            return redirect()->back()->with('message', 'Gagal Menambahkan Data Pegawai');
        }

        return redirect()->back()->with('message', 'Berhasil Menambahkan Data Pegawai');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Inertia\Response
     */
    public function show(Pegawai $pegawai)
    {
        $peg = $pegawai->where('id', $pegawai->id)->with('user')->with('golongan')->first();

        return inertia()->render('Pegawai/Show', [
            'pegawai' => $peg,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        // dd($pegawai);
        $data = Pegawai::where('id', $pegawai->id)->with('user')->first();
        return inertia()->render('Pegawai/Edit', [
            'pegawai' => $data,
            'golongan' => Golongan::all(),
        ]);
        // return response()->json($pegawai);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePegawaiRequest  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        Validator::make($request->all(), [
            'nip' => 'required|string|min:18|max:18',
            'nama' => 'required|string|max:255',
            'gelar_depan' => ['required', 'string', 'max:255'],
            'gelar_belakang' => ['required', 'string', 'max:255'],
            't_lahir' => ['required', 'string', 'max:255'],
            'tgl_lahir' => ['required', 'string', 'max:255'],
            'jns_kelamin' => ['required', 'in:L,P'],
            'instansi' => 'required|string',
            'kode_gol' => 'required|not_in:X',
            'jabatan' => 'required|string',
            'no_telp' => 'required',
        ], [
            't_lahir' => 'Tempat Lahir wajib diisi.',
            'tgl_lahir' => 'Tanggal Lahir bukan tanggal yang valid.',
            'jns_kelamin' => 'Jenis Kelamin yang dipilih tidak valid.',
            'no_telp' => 'No Telpon wajib diisi.',
            'kode_gol' => 'Golongan yang dipilih tidak valid.',
        ])->validateWithBag('updatePegawaiInformation');

        Pegawai::updateOrCreate([
            'id' => $pegawai->id,
        ], [
            'nip' => $request->nip,
            'nama' => $request->nama,
            'gelar_depan' => $request->gelar_depan,
            'gelar_belakang' => $request->gelar_belakang,
            't_lahir' => $request->t_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'jns_kelamin' => $request->jns_kelamin,
            'golongan_id' => $request->kode_gol,
            'no_telp' => $request->no_telp,
            'jabatan' => $request->jabatan,
            'instansi' => $request->instansi,
        ]);
        // dd($request->all());
        return redirect()->back()->with('message', 'Berhasil Memperbarui Data Pegawai');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $user = User::find($pegawai->user_id);
        $skp = Skp::where('user_id', $pegawai->user_id)->get();
        if ($skp->count() > 0) {
            \DB::table('skp')->where('user_id', $pegawai->user_id)->delete();
        }

        $pegawai->delete();
        $user->delete();
    }
}
