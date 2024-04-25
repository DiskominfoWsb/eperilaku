<?php

namespace App\Http\Controllers;

use App\Models\Golongan;
use App\Models\Pegawai;
use App\Models\Setting;
use App\Models\User;
use Auth;
use File;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserAvatarController extends Controller
{
    public function profile()
    {
        $user = User::where('id', Auth::id())->with('pegawai')->first();
        //        return response()->json($user);
        $golongan = Golongan::all();
        // dd($user);
        // return response()->json($user->pegawai->foto);
        return inertia()->render('User/Profile', [
            'user' => $user,
            'golongan' => $golongan,
            'currentPhoto' => 'upload/profile/' . Auth::user()->photo, // Storage::disk('public')->get('public/upload/profile/'.Auth::user()->photo),
        ]);
    }

    public function store()
    {
        //
    }

    public function update_pegawai(Request $request)
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

        Auth::user()->pegawai()->updateOrCreate([
            'user_id' => Auth::id(),
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

        $user = Auth::user();
        $user->name = $request->nama;
        $user->username = $request->nip;
        $user->save();

        return redirect()->back()->with('message', 'Berhasil Memperbarui Data Pegawai');
    }

    public function update_profile(Request $request)
    {
        // dd($request->all());
        if (request('password') != null || request('password') != '') {
            $request->validate([
                'email' => 'required',
                'password' => ['required', 'confirmed'],
            ]);
            $user = Auth::user();
            $user->email = request('email');
            $user->password = Hash::make(request('password'));
            Auth::logout();

            return redirect('/');
        } else {
            $request->validate([
                'email' => 'required',
            ]);

            $user = Auth::user();
            $user->email = request('email');
        }
        $user->save();

        return redirect()->back()->with('message', 'Berhasil memperbarui data pengguna');
    }

    public function update_photo(Request $request)
    {
        Validator::make($request->only('photo'), [
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfilePhoto');

        $photo_name = Auth::user()->photo;
        $photo_name_new = Auth::user()->id . '.' . $request->file('photo')->getClientOriginalExtension();
        $request->photo->move(public_path('upload/profile'), $photo_name_new);

        if (File::exists(public_path('upload/profile' . $photo_name))) {
            File::delete(public_path('upload/profile' . $photo_name));
        }

        $user = Auth::user();
        $user->photo = $photo_name_new;
        $user->save();

        return redirect()->back()->with('message', 'Berhasil memperbarui foto pengguna');
    }

    public function manifest_json()
    {
        $setting = Setting::first();

        return response()->json([
            'short_name' => $setting->name,
            'name' => $setting->name,
            'description' => $setting->description,
            'start_url' => '/',
            'display' => 'standalone',
            'background_color' => '#60A5FA',
            'theme_color' => '#60A5FA',
            'lang' => 'id-ID',
            'icons' => [
                [
                    'src' => './favicon/favicon-16x16.png',
                    'sizes' => '16x16',
                    'type' => 'image/png',
                ],
                [
                    'src' => './favicon/favicon-32x32.png',
                    'sizes' => '32x32',
                    'type' => 'image/png',
                ],
                [
                    'src' => './favicon/favicon-64x64.png',
                    'sizes' => '64x64',
                    'type' => 'image/png',
                ],
                [
                    'src' => './favicon/favicon-96x96.png',
                    'type' => 'image/png',
                    'sizes' => '96x96',
                ],
                [
                    'src' => './favicon/favicon-192x192.png',
                    'type' => 'image/png',
                    'sizes' => '192x192',
                ],
                [
                    'src' => './favicon/favicon-512x512.png',
                    'type' => 'image/png',
                    'sizes' => '512x512',
                ],
                [
                    'src' => './favicon/maskable_icon.png',
                    'sizes' => '196x196',
                    'type' => 'image/png',
                    'purpose' => 'maskable',
                ],
            ],
            'serviceworker' => [
                'src' => 'sw.js',
            ],
            'related_applications' => [
                [
                    'platform' => 'web',
                    'url' => config('app.url'),
                ],
            ],
            'protocol_handlers' => [
                [
                    'protocol' => 'web+bkd',
                    'url' => '/skp/%s',
                ],
            ],
        ]);
    }
}
