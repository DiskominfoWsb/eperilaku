<?php

namespace App\Models;

use App\Enums\SkpStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skp extends Model
{
    use HasFactory, HasUlids;

    protected $primaryKey = 'uuid';

    protected $table = 'skp';

    protected $fillable = ['skp_mulai', 'skp_selesai', 'pegawai_id', 'user_id', 'atasan_id', 'rating_status'];

    protected $casts = [
        'status' => SkpStatus::class,
        'skp_mulai' => 'datetime:d-m-Y',
        'skp_selesai' => 'datetime:d-m-Y',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    public function atasan()
    {
        return $this->hasOne(Pegawai::class, 'id', 'atasan_id');
    }

    public function kinerja()
    {
        return $this->hasMany(Kinerja::class);
    }

    public function perilaku()
    {
        return $this->hasMany(Perilaku::class);
    }

    public function indikator()
    {
        return $this->hasMany(Indikator::class);
    }

    public function ekspektasi()
    {
        return $this->hasMany(Ekspektasi::class);
    }
}
