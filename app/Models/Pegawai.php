<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Pegawai extends Model
{
    use HasFactory, Searchable;

    protected $table = 'pegawai';

    protected $fillable = [
        'nip',
        'nama',
        'golongan_id',
        'instansi',
        't_lahir',
        'tgl_lahir',
        'kode_gol',
        'jabatan',
        'jns_kelamin',
        'no_telp',
        'gelar_depan',
        'gelar_belakang',
        'user_id',
    ];

    protected $casts = [
        'tgl_lahir' => 'datetime:Y-m-d',
    ];

    protected $appends = [
        'tanggal_lahir_formatted',
        'nama_formatted',
        'nama_instansi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function golongan()
    {
        return $this->belongsTo(Golongan::class);
    }

    public function instansi()
    {
        return $this->belongsTo(Instansi::class);
    }

    public function getNamaInstansiAttribute()
    {
        return Instansi::select('nama')->where('id', $this->instansi);
    }

    public function getTanggalLahirFormattedAttribute()
    {
        return \Carbon\Carbon::parse($this->tgl_lahir)->format('d F Y');
    }

    public function getNamaFormattedAttribute()
    {
        $depan = $this->gelar_depan != '-' ? $this->gelar_depan . ' ' : '';
        $belakang = $this->gelar_belakang != '-' ? ', ' . $this->gelar_belakang : '';

        return $depan . $this->nama . $belakang;
    }
}
