<?php

namespace App\Http\Controllers;

use App\Dosen;
use App\Jadwal;
use App\Mahasiswa;
use App\Menu;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //fetch
        $user = User::get()->where('row_status','1')->count();
        $jadwal = Jadwal::get()->where('row_status','1')->count();
        $mhs = Mahasiswa::get()->where('row_status','1')->count();
        $dosen = Dosen::get()->where('row_status','1')->count();
        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);
        return view('home',compact('menus','user','jadwal','mhs','dosen'));
    }
}
