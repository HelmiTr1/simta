<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Waktu;
use App\Waktusidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class WaktusidangController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->level_id !=1) {
            abort(403);
        }
        $menus = Menu::all()->where('row_status','1');
        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);
        return view('waktusidang.index',compact('menus','waktus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Waktusidang  $waktusidang
     * @return \Illuminate\Http\Response
     */
    public function show(Waktusidang $waktusidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Waktusidang  $waktusidang
     * @return \Illuminate\Http\Response
     */
    public function edit(Waktusidang $waktusidang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Waktusidang  $waktusidang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Waktusidang $waktusidang)
    {
        Waktusidang::where('id',$waktusidang->id)
            ->update([
                'status' => $request->status,
                'modified_by' => 'default',
                'modified_at' => now()
            ]);
            Alert::success('Berhasil!',"Aktivsi waktu sidang telah diubah.");
        return redirect('sidang/waktusidang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Waktusidang  $waktusidang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Waktusidang $waktusidang)
    {
        //
    }
}
