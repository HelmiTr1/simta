<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table ="tb_content";
    public $timestamps=false;

    public function level()
    {
        return $this->belongsTo('App\Level','id_level');
    }

    public function menu()
    {
        return $this->belongsTo('App\Menu','id_menu');
    }
}
