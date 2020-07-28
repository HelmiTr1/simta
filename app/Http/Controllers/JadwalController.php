<?php

namespace App\Http\Controllers;

use App\Bimbingan;
use App\Dosen;
use App\Jadwal;
use App\Mahasiswa;
use App\Menu;
use App\Ruangan;
use App\Waktusidang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Jenssegers\Date\Date;
use Acaronlex\LaravelCalendar\Calendar;
use RealRashid\SweetAlert\Facades\Alert;

class JadwalController extends Controller 
{

    public function __construct()
    {
        $this->middleware('auth');
        set_time_limit(0);
        
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
        return view('jadwal.index',compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'generasi' => 'required',
            'batch' => 'required',
            'populasi' => 'required',
            'crossover' => 'required',
            'mutasi' => 'required',
            'mulai' => 'required',

        ]);
        $generasi = $request->generasi;
        $batch = $request->batch;
        $populasi = $request->populasi;
        $crossover = $request->crossover;
        $mutasi = $request->mutasi;
        $tglStart = $request->start;
        $tglEnd = $request->end;
        $tglMulai = $request->mulai;
        $x=0;
        for ($i=0; $i < 45; $i=$i+4) {
            if($i==0){
                $stamp=strtotime($tglMulai);

            }else{
                $stamp=strtotime('+'.$x.' days', strtotime($tglMulai));
            }

            $date[$i] = date('Y-m-d', $stamp);
            $date[$i+1] = date('Y-m-d', $stamp);
            $date[$i+2] = date('Y-m-d', $stamp);
            $date[$i+3] = date('Y-m-d', $stamp);
            $x=$x+1;
        }
        // var_dump($date);die;
        $data =[
            'generasi' => $generasi,
            'batch' => $batch,
            'populasi' => $populasi,
            'crossover' => $crossover,
            'mutasi' => $mutasi
        ];
        $mhs_cek = Bimbingan::get()->where('row_status','1');
        foreach ($mhs_cek as $data ) {
            $jadwal_cek = Jadwal::get()->where('row_status','1')->where('id_bimbingan',$data->id);
        }
        $jad_cek = count($jadwal_cek);
        // // return $jadwal_cek != null ? true : '0';
        if ($jad_cek == 0) {
            $algorithm = new AlgorithmController($batch,$populasi,$crossover,$mutasi);
    
            $algorithm->GetData();
            // return $dd;
            $algorithm->inisialisasi();
            $cek = Jadwal::get()->where('row_status','1')->where('batch', $batch)->first();
    
            $found = false;
            for($i = 0;$i < $generasi;$i++ ){
                $fitness = $algorithm->HitungFitness();
                $algorithm->Seleksi($fitness);
                $algorithm->Crossover();
                $fitnessAfterMutation = $algorithm->Mutasi();
                $index = 0;
                for ($j = 0; $j < count($fitnessAfterMutation); $j++){
                    
                    if($fitnessAfterMutation[$j] == 1){
                //         // $index += $j;
                        if ($cek) {
                            // return true;
                            Jadwal::where('batch',$batch)->delete();
                        }
                        $jadwal= array(array());
                        $jadwal = $algorithm->GetIndividu($j);
                        for ($k=0; $k < count($jadwal); $k++) {
                            $id_bimbingan = $jadwal[$k][0];
                            $id_waktusidang = $jadwal[$k][1];
                            $id_ruangan = $jadwal[$k][2];
                            $id_dospen1 = $jadwal[$k][3];
                            $id_dospen2 = $jadwal[$k][4];
    
                            DB::table('tb_jadwalsidang')->insert([
                                'id_bimbingan' => $id_bimbingan,
                                'id_waktusidang' => $id_waktusidang,
                                'id_ruangan' => $id_ruangan,
                                'dospen1' => $id_dospen1,
                                'dospen2' => $id_dospen2,
                                'input_by' =>Auth::user()->username,
                                'input_at' => now(),
                                'batch' =>$batch,
                                'tanggal' => $date[$k],
                                'row_status' => '1'
                            ]);
                        }
                        $found = true;	
                    }
                    if($found){break;}
                }
                if($found){break;}
            }
            Alert::success('Berhasil!',"Jadwal Sidang telah berhasil digenerate!")->persistent('Close');
            return redirect('sidang/jadwal/result');
            // return $fitness;
        }else{
            Alert::success('Warning!',"Mahasiswa yang dipilih sudah memiliki jadwal!")->persistent('Close');
            return redirect('sidang/jadwal/result');

        }
        

    }
    public function result()
    {
        $jadwal = DB::table('tb_jadwalsidang AS x')
                    ->select('x.tanggal','x.id','a.nama as mhs','b.nama as dospem1', 'c.nama AS dospem2', 
                            'd.nidn as dosen1','d.nama AS dospen1','e.nidn as dosen2', 'e.nama As dospen2','f.hari as hari',
                            'g.waktu as waktu', 'h.nama_ruangan as ruangan','h.kode_ruangan as kode_ruangan','batch')
                            ->join('tb_bimbingan AS y','y.id','=','x.id_bimbingan','inner')
                            ->join('tb_waktusidang AS z','z.id','=','x.id_waktusidang','inner')
                            ->join('tb_mahasiswa AS a','a.nim','=','y.nim','left')
                            ->join('tb_dosen AS b','b.nidn','=','y.dospem1','left')
                            ->join('tb_dosen AS c','c.nidn','=','y.dospem2','left')
                            ->join('tb_dosen AS d','d.nidn','=','x.dospen1','left')
                            ->join('tb_dosen AS e','e.nidn','=','x.dospen2','left')
                            ->join('tb_hari AS f','f.id','=','z.id_hari','left')
                            ->join('tb_waktu AS g','g.id','=','z.id_waktu','left')
                            ->join('tb_ruangan AS h','h.id','=','x.id_ruangan','left')->orderBy('id_waktusidang','desc')
                            ->get();
                            // return $jadwal;
        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);
        $dospen1 = Dosen::get()->where('row_status','1');
        $dospen2 = Dosen::get()->where('row_status','1');
        return view('jadwal.result',compact('menus','jadwal','dospen1','dospen2'));
        
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function show(Jadwal $jadwal)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function edit(Jadwal $jadwal)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jadwal $jadwal)
    {
        if (Auth::user()->level_id !=1) {
            abort(403);
        }
        Jadwal::where('id', $jadwal->id)
          ->update([
              'dospen1' => $request->dospen1,
              'dospen2' => $request->dospen2,
              'modified_by' => Auth::user()->username,
              'modified_at' => now(),
              ]);
              Alert::success('berhasil!',"Data jadwal berhasil diubah!")->persistent('Close');
        return redirect('sidang/jadwal/result');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        //
    }

    public function detail(Request $request)
    {
        $jadwal = DB::table('tb_jadwalsidang AS x')
                    ->select('x.tanggal','x.id','a.nama as mhs','y.nim','b.nidn as dosenp1','b.nama as dospem1','c.nidn as dosenp2', 'c.nama AS dospem2', 
                            'd.nidn as dosen1','d.nama AS dospen1','e.nidn as dosen2', 'e.nama As dospen2','f.hari as hari',
                            'g.waktu as waktu', 'h.nama_ruangan as ruangan','h.kode_ruangan as kode_ruangan','batch')
                            ->join('tb_bimbingan AS y','y.id','=','x.id_bimbingan','inner')
                            ->join('tb_waktusidang AS z','z.id','=','x.id_waktusidang','inner')
                            ->join('tb_mahasiswa AS a','a.nim','=','y.nim','left')
                            ->join('tb_dosen AS b','b.nidn','=','y.dospem1','left')
                            ->join('tb_dosen AS c','c.nidn','=','y.dospem2','left')
                            ->join('tb_dosen AS d','d.nidn','=','x.dospen1','left')
                            ->join('tb_dosen AS e','e.nidn','=','x.dospen2','left')
                            ->join('tb_hari AS f','f.id','=','z.id_hari','left')
                            ->join('tb_waktu AS g','g.id','=','z.id_waktu','left')
                            ->join('tb_ruangan AS h','h.id','=','x.id_ruangan','left')->orderBy('id_waktusidang','ASC')
                            ->get();
        $jadwal2 = DB::table('tb_jadwalsidang AS x')
                    ->select('x.tanggal','x.id','a.nama as mhs','y.nim','b.nidn as dosenp1','b.nama as dospem1','c.nidn as dosenp2', 'c.nama AS dospem2', 
                            'd.nidn as dosen1','d.nama AS dospen1','e.nidn as dosen2', 'e.nama As dospen2','f.hari as hari',
                            'g.waktu as waktu', 'h.nama_ruangan as ruangan','h.kode_ruangan as kode_ruangan','batch')
                            ->join('tb_bimbingan AS y','y.id','=','x.id_bimbingan','inner')
                            ->join('tb_waktusidang AS z','z.id','=','x.id_waktusidang','inner')
                            ->join('tb_mahasiswa AS a','a.nim','=','y.nim','left')
                            ->join('tb_dosen AS b','b.nidn','=','y.dospem1','left')
                            ->join('tb_dosen AS c','c.nidn','=','y.dospem2','left')
                            ->join('tb_dosen AS d','d.nidn','=','x.dospen1','left')
                            ->join('tb_dosen AS e','e.nidn','=','x.dospen2','left')
                            ->join('tb_hari AS f','f.id','=','z.id_hari','left')
                            ->join('tb_waktu AS g','g.id','=','z.id_waktu','left')
                            ->join('tb_ruangan AS h','h.id','=','x.id_ruangan','left')->orderBy('id_waktusidang','ASC')
                            ->where('b.nidn',Auth::user()->username)
                            ->orWhere('c.nidn',Auth::user()->username)
                            ->orWhere('d.nidn',Auth::user()->username)
                            ->orWhere('e.nidn',Auth::user()->username)
                            ->get();
        $s = $request->s;
        $dosen = Dosen::get()->where('nidn',Auth::user()->username)->first();
        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);
        return view('jadwal.detail',compact('menus','jadwal','jadwal2','s','dosen'));
    }
}
