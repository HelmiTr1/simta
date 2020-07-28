<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model 
{
    protected $table ='tb_jadwalsidang';
    public $timestamps = false;

    public function getEventOptions()
    {
        return [
            'color' => $this->background_color,
        ];
    }
}
