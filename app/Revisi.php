<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Revisi extends Model
{
    protected $table = 'tb_revisi';
    public $timestamps = false;

    public function mahasiswa(){
        return $this->belongsTo('App\Mahasiswa','nim');
    }

    public function latest($column)
    {
    return $this->orderBy($column,'desc');
    }
}
