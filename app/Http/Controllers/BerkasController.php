<?php

namespace App\Http\Controllers;

use App\Bimbingan;
use App\Content;
use App\Jadwal;
use App\Menu;
use App\Revisi;
use Illuminate\Support\Facades\File; 
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use RealRashid\SweetAlert\Facades\Alert;

class BerkasController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
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
        $id = Menu::all()->where('url', request()->path());
        foreach($id as $i){
            $id = $i->id;
        }
        $content = Content::get()->where('row_status','1')->where('id_level',Auth::user()->level_id)->where('id_menu',$id);
        $jadwal = array();
        if (Auth::user()->level_id !=1) {
            $bimbingan =  Bimbingan::all()->where('nim',Auth::user()->username);
            // var_dump($bimbingan);die;
            foreach ($bimbingan as $data) {
                $id_bimbingan = $data->id;
            }
            $jadwal = Jadwal::get()->where('row_status','1')->where('id_bimbingan',$id_bimbingan);
        }
        $revisi = Revisi::get()->where('nim',Auth::user()->username)->where('status','1')->where('row_status','1')->sortByDesc('input_at');
        return view('berkas.index',compact('menus','content','revisi','jadwal'));
    }
    public function show(Revisi $berkas)
    {
        $file = storage_path('app/public'.'/'.$berkas->filename);
        $headers = [
            'Content-Type' => 'application/pdf'
        ];

        return response()->download($file, 'Lampiran Revisi', $headers, 'inline');
    }
    public function store(Request $request)
    {
        if (Auth::user()->level_id!='3') {
            abort(403);
        }
        if ($request->ajax()) {
            $data = $request->post('filename');
            $data = explode(".",$data);
            $filename = md5(Auth::user()->username).'.'.$data[1];
            // $data->move(public_path('storage'),$filename);
            // $params =[
            //     'nim' => Auth::user()->username,
            //     'filename' => $filename,
            //     'input_by' =>Auth::user()->username,
            //     'input_at' => now(),
            //     'row_status' => '1',
            //     'status' => '1'
            // ];
            // Revisi::create($params);
            $revisi = new Revisi;
            $revisi->nim = Auth::user()->username;
            $revisi->filename = $filename;
            $revisi->input_by = Auth::user()->username;
            $revisi->input_at = now();
            $revisi->row_status = '1';
            $revisi->status ='1';
            $revisi->save();
            return response()->json([
                'success' => 'done'
            ]);
        }
    }
    public function destroy(Revisi $revisi)
    {
        if (Auth::user()->level_id !=3) {
            abort(403);
        }
        Revisi::where('id', $revisi->id)
          ->update([
              'modified_by' => Auth::user()->username,
              'modified_at' => now(),
              'row_status' => '-1'
              ]);
            //   $file_path= parse_url(url('storage').'/'.$revisi->filename);
            //   $file_path= URL::to('storage/507a9ecc17bc9c918987e3b3fd4dc280.pdf');
            //   unlink($file_path);
            // if(Storage::disk('public')->delete($file_path)){
            //     return 'true';
            // }else{
            //     return 'false';
            // }
            // return $file_path;
            Alert::success('Berhasil!','Berkas lampiran revisi dihapus')->persistent('Close');
        return redirect('berkas')->with('status');
    }
    
}
