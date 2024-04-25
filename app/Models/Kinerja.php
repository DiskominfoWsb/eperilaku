<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Kinerja extends Model
{
    use HasFactory, Searchable, HasUuids;

    protected $primaryKey = 'uuid';

    protected $table = 'kinerja';

    protected $fillable = [
        'jenis',
        'skp_id',
        'rencana_intervensi',
        'rencana',
        'aspek',
        'indikator',
        'target',
    ];

    public function skp()
    {
        return $this->belongsTo(Skp::class);
    }

    public function indikator()
    {
        return $this->hasMany(Indikator::class);
    }
}
