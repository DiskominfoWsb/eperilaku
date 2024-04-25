<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Golongan extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid';

    protected $table = 'golongan';

    protected $appends = ['golongan_name_formatted'];

    public function getGolonganNameFormattedAttribute()
    {
        return $this->golongan.'/'.$this->ruang.' '.$this->pangkat;
    }
}
