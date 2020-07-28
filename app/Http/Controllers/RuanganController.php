<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $ruangan = Ruangan::get()->where('row_status','1');
        return view('ruangan.index',compact('menus','ruangan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);
        return view('ruangan.add',compact('menus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_ruangan' => 'required|unique:App\Ruangan,kode_ruangan',
            'ruangan' => 'required'
        ]);

        $ruangan = new Ruangan;
        $ruangan->kode_ruangan = $request->kode_ruangan;
        $ruangan->nama_ruangan = $request->ruangan;
        $ruangan->input_by = Auth::user()->username;
        $ruangan->input_at = now();
        $ruangan->row_status = '1';
        $ruangan->save();
            Alert::success("Berhasil!","Data ruangan berhasil ditambah")->persistent('Close');
        return redirect('sidang/ruangan');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function show(Ruangan $ruangan)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function edit(Ruangan $ruangan)
    {
        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);
        // return $ruangan;
        return view('ruangan.edit',compact('menus','ruangan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        $request->validate([
            'kode_ruangan' => 'required',
            'ruangan' => 'required'
        ]);

        Ruangan::where('id' , $ruangan->id)
            ->update([
                'kode_ruangan' => $request->kode_ruangan,
                'nama_ruangan' => $request->ruangan,
                'modified_by' =>Auth::user()->username,
                'modified_at' =>now()
            ]);
            Alert::success("Berhasil!","Data ruangan berhasil diedit")->persistent('Close');
            return redirect('sidang/ruangan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruangan $ruangan)
    {
        Ruangan::where('id' , $ruangan->id)
            ->update([
                'row_status' => '-1',
                'modified_by' =>Auth::user()->username,
                'modified_at' =>now()
            ]);
            Alert::success("Berhasil!","Data ruangan berhasil dihapus")->persistent('Close');
            return redirect('sidang/ruangan');
    }
}
