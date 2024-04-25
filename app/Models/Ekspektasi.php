<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ekspektasi extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid';

    protected $table = 'ekspektasi';

    protected $fillable = [
        'jenis',
        'prilaku',
        'ekspektasi_atasan',
        'ekspektasi_feedback',
        'skp_id',
    ];

    public function skp()
    {
        return $this->belongsTo(Skp::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function atasan()
    {
        return $this->belongsTo(Pegawai::class, 'id', 'atasan_id');
    }
}
