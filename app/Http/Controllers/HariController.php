<?php

namespace App\Http\Controllers;

use App\Hari;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HariController extends Controller
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
        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);
        $hari = Hari::all()->where('row_status','1');
        return view('hari.index',compact('menus','hari'));
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
     * @param  \App\Hari  $hari
     * @return \Illuminate\Http\Response
     */
    public function show(Hari $hari)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Hari  $hari
     * @return \Illuminate\Http\Response
     */
    public function edit(Hari $hari)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Hari  $hari
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Hari $hari)
    {
        Hari::where('id',$hari->id)
            ->update([
                'status' => $request->status,
                'modified_by' => 'default',
                'modified_at' => now()
            ]);
        
        return redirect('sidang/hari');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Hari  $hari
     * @return \Illuminate\Http\Response
     */
    public function destroy(Hari $hari)
    {
    }
}
