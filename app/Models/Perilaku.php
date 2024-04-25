<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perilaku extends Model
{
    use HasFactory;

    protected $table = 'perilaku';

    public function skp()
    {
        return $this->belongsTo(Skp::class);
    }
}
