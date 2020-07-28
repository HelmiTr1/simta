<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Revisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Jenssegers\Date\Date;
use RealRashid\SweetAlert\Facades\Alert;

class RevisiController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Date::setLocale('id');
        $params = $request->s;
        $revisi1 =[];
        $revisi2 =[];
        if ($params =='terima') {
            $revisi1 = Revisi::get()->where('row_status','1')->where('status','1');
        }elseif ($params=='tolak') {
            $revisi2 = Revisi::get()->where('row_status','1')->where('status','-1');
            
        }

        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);
        return view('revisi.index',compact('menus','revisi1','revisi2','params'));
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
     * @param  \App\Revisi  $revisi
     * @return \Illuminate\Http\Response
     */
    public function show(Revisi $revisi)
    {
        $file = storage_path('app/public'.'/'.$revisi->filename);
        $headers = [
            'Content-Type' => 'application/pdf'
        ];

        return response()->download($file, 'Lampiran Revisi', $headers, 'inline');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Revisi  $revisi
     * @return \Illuminate\Http\Response
     */
    public function edit(Revisi $revisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Revisi  $revisi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Revisi $revisi)
    {
        if (Auth::user()->level_id !=1) {
            abort(403);
        }
        Revisi::where('id', $revisi->id)
          ->update([
              'modified_by' => Auth::user()->username,
              'modified_at' => now(),
              'status' => '-1'
              ]);
        Alert::success('Berhasil!','Lampiran revisi ditolak')->persistent('Close');

        return redirect('berkas/revisi?s=terima');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Revisi  $revisi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Revisi $revisi)
    {
        if (Auth::user()->level_id !=1) {
            abort(403);
        }
        Revisi::where('id', $revisi->id)
          ->update([
              'modified_by' => Auth::user()->username,
              'modified_at' => now(),
              'row_status' => '-1'
              ]);
        Alert::success('Berhasil!','Berkas lampiran revisi dihapus')->persistent('Close');
        return redirect('berkas/revisi?s=tolak');  
    }
}
