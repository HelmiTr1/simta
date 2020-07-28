<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Waktu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WaktuController extends Controller
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
        $waktu = Waktu::all()->where('row_status','1');
        return view('waktu.index',compact('menus','waktu'));
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
     * @param  \App\Waktu  $waktu
     * @return \Illuminate\Http\Response
     */
    public function show(Waktu $waktu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Waktu  $waktu
     * @return \Illuminate\Http\Response
     */
    public function edit(Waktu $waktu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Waktu  $waktu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Waktu $waktu)
    {
        Waktu::where('id',$waktu->id)
            ->update([
                'status' => $request->status,
                'modified_by' => 'default',
                'modified_at' => now()
            ]);
        
        return redirect('sidang/waktu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Waktu  $waktu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Waktu $waktu)
    {
        //
    }
}
