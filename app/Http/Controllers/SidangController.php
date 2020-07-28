<?php

namespace App\Http\Controllers;

use App\Content;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SidangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);
        $id = Menu::all()->where('url', request()->path());
        foreach($id as $i){
            $id = $i->id;
        }

        $level = Auth::user()->level_id;
        $content = Content::all()->where('id_menu',$id)->where('row_status','1')->where('id_level',$level)->sortBy('id_level');
        return view('sidang.index',compact('menus','content'));
    }
}
