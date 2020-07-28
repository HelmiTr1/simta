<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waktusidang extends Model
{
    protected $table='tb_waktusidang';
    public $timestamps=false;

    public function waktu()
    {
        return $this->hasMany('App\Waktu','id','id_waktu');
    }
    public function hari()
    {
        return $this->hasMany('App\Hari','id','id_hari');
    }
}
