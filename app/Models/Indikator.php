<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Indikator extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid';

    protected $table = 'indikator';

    public function skp()
    {
        return $this->belongsTo(Skp::class);
    }

    public function kinerja()
    {
        return $this->belongsTo(Kinerja::class);
    }
}
