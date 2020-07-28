<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class MenuController extends Controller
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
        // var_dump($menus);die;
        $menu = Menu::all()->where('row_status','1');
        return view('menu.index',compact('menu','menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->level_id !=1) {
            abort(403);
        }
        $menu = Menu::all()->where('row_status','1');
        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);

        return view('menu.add',compact('menu','menus'));
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
            'menu' => 'required',
            'icon' => 'required',
            'url'  => 'required'
        ]);
        $menu = new Menu;
        $menu->menu = $request->menu;
        $menu->url = $request->url;
        $menu->icon = $request->icon;
        $menu->input_by = Auth::user()->username;
        $menu->input_at = now();
        $menu->row_status= '1';
        $menu->save();
        Alert::success("Berhasil!","Data menu berhasil disimpan.");
        return redirect('menu');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
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

        return view('menu.edit',compact('menu','menus'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'menu' => 'required',
            'icon' => 'required',
            'url'  => 'required'
        ]);

        Menu::where('id',$menu->id)
            ->update([
                'menu' => $request->menu,
                'url'   => $request->url,
                'icon'  => $request->icon,
                'modified_by' => Auth::user()->username,
                'modified_at' => now()
            ]);
            Alert::success("Berhasil!","Data menu berhasil diubah.")->persistent('Close');
        
        return redirect('menu');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        Menu::where('id',$menu->id)
            ->update([
                'row_status' => '-1',
                'modified_by' => Auth::user()->username,
                'modified_at' => now()
            ]);
            Alert::success("Berhasil!","Data menu berhasil dihapus.")->persistent('Close');
        
        return redirect('menu');
    }
}
