<?php

namespace App\Http\Controllers;

use App\Content;
use App\Level;
use App\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ContentController extends Controller
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
        $content = Content::all()->where('row_status','1');
        // $content = Content::all();
        return view('content.index',compact('menus','content'));
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
        $level = Level::all();
        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);

        $menus = Menu::all()->where('row_status','1');
        return view('content.add',compact('menus','menu','level'));
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
            'content' => 'required',
            'isi'   => 'required',
            'url'   => 'required',
            'icon'  => 'required',
            'level' => 'required',
            'menu' => 'required',
        ]);

        $content = new Content;
        $content->judul = $request->content;
        $content->isi = $request->isi;
        $content->url = $request->url;
        $content->icon = $request->icon;
        $content->id_level = $request->level;
        $content->id_menu = $request->menu;
        $content->input_by = Auth::user()->username;
        $content->input_at = now();
        $content->row_status = '1';
        $content->save();
        Alert::success("Berhasil","Data content berhasil disimpan")->persistent('Close');
        return redirect('content');

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
    public function edit(Content $content)
    {
        if (Auth::user()->level_id !=1) {
            abort(403);
        }
        $level = Level::all();
        $menu = Menu::all()->where('row_status','1');

        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);
        return view('content.edit',compact('menus','menu','level','content'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        $request->validate([
            'content' => 'required',
            'isi'   => 'required',
            'url'   => 'required',
            'icon'  => 'required',
            'level' => 'required',
            'menu' => 'required',
        ]);

        Content::where('id',$content->id)
            ->update([
                'judul' => $request->content,
                'isi'   => $request->isi,
                'url'   => $request->url,
                'icon'  => $request->icon,
                'modified_by' => Auth::user()->username,
                'modified_at' => now(),
            ]);
            Alert::success("Berhasil","Data content berhasil diubah")->persistent('Close');
        return redirect('content');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        if (Auth::user()->level_id !=1) {
            abort(403);
        }
        Content::where('id', $content->id)
          ->update([
              'modified_by' => Auth::user()->username,
              'modified_at' => now(),
              'row_status' => '-1'
              ]);
              Alert::success("Berhasil","Data content berhasil dihapus")->persistent('Close');
        return redirect('content');
    }
}
