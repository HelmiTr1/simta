<?php

namespace App\Http\Controllers;

use App\Aspeknilai;
use App\Bimbingan;
use App\Mahasiswa;
use App\Menu;
use App\Nilai;
use Jenssegers\Date\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;
use Codedge\Fpdf\Fpdf\Fpdf;
use RealRashid\SweetAlert\Facades\Alert;

class NilaiController extends Controller
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
        $dosen = DB::table('tb_jadwalsidang AS x')
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
                            ->join('tb_ruangan AS h','h.id','=','x.id_ruangan','left')->orderBy('id_waktusidang','desc')
                            ->where('b.nidn',Auth::user()->username)
                            ->orWhere('c.nidn',Auth::user()->username)
                            ->orWhere('d.nidn',Auth::user()->username)
                            ->orWhere('e.nidn',Auth::user()->username)
                            ->get();
            $i=0;
            $nilais = array();
            $nilaip = array();
        foreach ($dosen as $data ) {    
            $id_bimbingan = Bimbingan::get()->where('row_status','1')->where('nim',$data->nim)->first();
            $aspekNilais = Aspeknilai::get()->where('row_status','1')->where('kategori','sidang')->first();
            $aspekNilaip = Aspeknilai::get()->where('row_status','1')->where('kategori','proses')->first();
            $nilais[$i] = Nilai::get()->where('row_status','1')->where('id_bimbingan',$id_bimbingan->id)->where('id_dosen',Auth::user()->username)->where('id_aspeknilai',$aspekNilais->id);
            $nilaip[$i] = Nilai::get()->where('row_status','1')->where('id_bimbingan',$id_bimbingan->id)->where('id_dosen',Auth::user()->username)->where('id_aspeknilai',$aspekNilaip->id);
            $i++;
        }
        // $nilai = Nilai::get()->where('row_status','1');
        // $aspekNilai = Aspeknilai::get()->where('row_status','1')->where('kategori','sidang');
        return view('nilai.index',compact('menus','dosen','nilais','nilaip'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Request $request)
    {
        $nilai = $request->id;
        $kategory = $request->p == 'p' ? 'proses' : 'sidang';
        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);
        $mhs = Mahasiswa::find($nilai);
        $aspekNilai = Aspeknilai::get()->where('row_status','1')->where('kategori',$kategory);
        return view('nilai.add',compact('menus','nilai','mhs','aspekNilai'));
        // return $request->id;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'nilai' => 'required',
            'nilai.*' => 'required'
        ]);
        $nilai = $request->idc;
        $id_bimbingan = Bimbingan::get()->where('nim',$nilai)->first();
        for ($i=1; $i <= $request->id; $i++) {
            $nilaiI = new  Nilai;
            $nilaiI->id_bimbingan = $id_bimbingan->id;
            $nilaiI->id_dosen = Auth::user()->username;
            $nilaiI->id_aspeknilai = $request->ian[$i];
            $nilaiI->nilai = $request->nilai[$i];
            $nilaiI->status ='1';
            $nilaiI->input_by = Auth::user()->username;
            $nilaiI->input_at = now();
            $nilaiI->row_status = '1';
            $nilaiI->save();
        }
        Alert::success("Berhasil!","Nilai mahasiswa Berhasil diisi")->persistent('Close');
        return redirect('sidang/nilai');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function show(Nilai $nilai)
    {
        //
    }
    public function detail(Request $request)
    {
        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);
        $nim = $request->id ? $request->id :Auth::user()->username;
        $mhs= DB::table('tb_jadwalsidang AS x')
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
                        ->join('tb_ruangan AS h','h.id','=','x.id_ruangan','left')->orderBy('id_waktusidang','desc')
                        ->where('y.nim',$nim)
                        ->get();
        $dosen = array();
        $dosenp = array();
        foreach ($mhs as $data ) {
            $dosen[0] = $data->dosenp1;
            $dosen[1] = $data->dosenp2;
            $dosen[2] = $data->dosen1;
            $dosen[3] = $data->dosen2;
            $dosenp[0] = $data->dosenp1;
            $dosenp[1] = $data->dosenp2;
        }
        $aspekNilai = Aspeknilai::get()->where('row_status','1')->where('kategori','sidang');
        $aspekNilai2 = Aspeknilai::get()->where('row_status','1')->where('kategori','proses');
        return view('nilai.detail',compact('menus','nim','mhs','aspekNilai','aspekNilai2','dosen','dosenp'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $nilai)
    {
        $kategory = $request->p == 'p' ? 'proses' : 'sidang';
        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);
        $mhs = Mahasiswa::find($nilai);
        $bimbingan = Bimbingan::get()->where('nim',$nilai)->first();
        $aspekNilai = Aspeknilai::get()->where('row_status','1')->where('kategori',$kategory);
        $nilx = Nilai::get()->where('id_bimbingan',$bimbingan->id)->first();
        $nilaix=array();
        $i=1;
        foreach ($aspekNilai as $data ) {
            $nilaix[$i] = Nilai::get()->where('id_bimbingan',$nilx->id_bimbingan)->where('id_dosen',Auth::user()->username)->where('id_aspeknilai',$data->id)->first();
            $i++;
        }
        // return $nilaix;
        return view('nilai.edit',compact('menus','nilai','nilaix','mhs','aspekNilai'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nilai)
    {
        $id_bimbingan = Bimbingan::get()->where('nim',$nilai)->first();
        for ($i=1; $i <= $request->id; $i++) {
            Nilai::where('id_bimbingan',$id_bimbingan->id)
                    ->where('id_aspeknilai',$request->ian[$i])
                    ->where('id_dosen',Auth::user()->username)
                    ->update([
                        'nilai' => $request->nilai[$i],
                        'modified_by' => Auth::user()->username,
                        'modified_at' =>now()
                    ]);

        }
        Alert::success("Berhasil!","Nilai mahasiswa berhasil diubah")->persistent('Close');
        return redirect('sidang/nilai');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Nilai  $nilai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Nilai $nilai)
    {
        //
    }
    public function rekap(Request $request)
    {
        $access= DB::table('tb_menuaccess')->get()->where('id_level',Auth::user()->level_id);
        $izin = array();
        $i=0;
        foreach ($access as $data ) {
            $izin[$i] = $data->id_menu;
            $i++;
        }
        $menus = Menu::all()->where('row_status','1')->whereIn('id',$izin);
        $nim = $request->id ? $request->id :'';
        $mhs= DB::table('tb_jadwalsidang AS x')
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
                        ->join('tb_ruangan AS h','h.id','=','x.id_ruangan','left')->orderBy('id_waktusidang','desc')
                        ->where('y.nim',$nim)
                        ->get();
        $dosen = array();
        $dosenp = array();
        foreach ($mhs as $data ) {
            $dosen[0] = $data->dosenp1;
            $dosen[1] = $data->dosenp2;
            $dosen[2] = $data->dosen1;
            $dosen[3] = $data->dosen2;
            $dosenp[0] = $data->dosenp1;
            $dosenp[1] = $data->dosenp2;
        }
        // return $mhs;
        $aspekNilai = Aspeknilai::get()->where('row_status','1')->where('kategori','sidang');
        $aspekNilai2 = Aspeknilai::get()->where('row_status','1')->where('kategori','proses');
        // $menus = Menu::get()->where('row_status','1');
        $mhs2 = DB::table('tb_mahasiswa')->where('row_status','1')->get();
        return view('nilai.index2',compact('menus','mhs','mhs2','dosen','dosenp','aspekNilai','aspekNilai2','nim'));
        // return $mhs;
    }

    public function cetak(Request $request)
    {
        $mhs = DB::table('tb_jadwalsidang AS x')
        ->select('x.tanggal','x.id','y.id as bid','a.nama as mhs','y.nim','b.nidn as dosenp1','y.judul','b.nama as dospem1','c.nidn as dosenp2', 'c.nama AS dospem2', 
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
                ->where('y.nim',$request->id)
                ->get()->first();

        //FETCHING DATA NILAI
        $aspekNilai = Aspeknilai::get()->where('row_status','1')->where('kategori','sidang');
        $aspekNilai2 = Aspeknilai::get()->where('row_status','1')->where('kategori','proses');

        //pengerjaan TA
        //PEMBIMBING 1
        $an1 = array();
        $bot1 = array();
        $i=0;
        foreach ($aspekNilai2 as $data ) {
            $an1[$i] = $data->id;
            $bot1[$i] = $data->bobot/100;
            $i++; 
        }
        for ($i=0; $i < count($an1); $i++) { 
            $nilai = Nilai::get()->where('id_dosen',$mhs->dosenp1)->where('id_bimbingan',$mhs->bid)->where('id_aspeknilai',$an1[$i])->first();
            $nilaip11[$i] = $nilai == null ? 0 : $nilai->nilai;
        }
        //PEMBIMBING 2
        for ($i=0; $i < count($an1); $i++) { 
            $nilai = Nilai::get()->where('id_dosen',$mhs->dosenp2)->where('id_bimbingan',$mhs->bid)->where('id_aspeknilai',$an1[$i])->first();
            $nilaip12[$i] = $nilai == null ? 0 : $nilai->nilai;
        }

        //SIDANG TA
        $an2 = array();
        $bot2 = array();
        $i=0;
        foreach ($aspekNilai as $data ) {
            $an2[$i] = $data->id;
            $bot2[$i] = $data->bobot/100;
            $i++; 
        }
        //PEMBIMBING 1
        for ($i=0; $i < count($an2); $i++) { 
            $nilai = Nilai::get()->where('id_dosen',$mhs->dosenp1)->where('id_bimbingan',$mhs->bid)->where('id_aspeknilai',$an2[$i])->first();
            $nilaip21[$i] = $nilai == null ? 0 : $nilai->nilai;
        }
        //PEMBIMBING 2
        for ($i=0; $i < count($an2); $i++) { 
            $nilai = Nilai::get()->where('id_dosen',$mhs->dosenp2)->where('id_bimbingan',$mhs->bid)->where('id_aspeknilai',$an2[$i])->first();
            $nilaip22[$i] = $nilai == null ? 0 : $nilai->nilai;
        }
        //PENGUJI 1
        for ($i=0; $i < count($an2); $i++) { 
            $nilai = Nilai::get()->where('id_dosen',$mhs->dosen1)->where('id_bimbingan',$mhs->bid)->where('id_aspeknilai',$an2[$i])->first();
            $nilaip23[$i] = $nilai == null ? 0 : $nilai->nilai;
        }
        //PENGUJI 2
        for ($i=0; $i < count($an2); $i++) { 
            $nilai = Nilai::get()->where('id_dosen',$mhs->dosen2)->where('id_bimbingan',$mhs->bid)->where('id_aspeknilai',$an2[$i])->first();
            $nilaip24[$i] = $nilai == null ? 0 : $nilai->nilai;
        }
        $nilp1 = 0;
        $nilp2 = 0;
        $nilu1 = 0;
        $nilu2 = 0;
        $nilu3 = 0;
        $nilu4 = 0;
        for ($i=0; $i < count($an1); $i++) {
            if ($nilaip11[$i] == null) {
                $nilaip11[$i] = 0;
            }
            if ($nilaip12[$i] == null) {
                $nilaip12[$i] = 0;
            }
            $nilp1 += $bot1[$i]*$nilaip11[$i];
            $nilp2 += $bot1[$i]*$nilaip12[$i];
        }
        for ($i=0; $i < count($an2); $i++) {
            if ($nilaip21[$i] == null) {
                $nilaip21[$i] = 0;
            }
            if ($nilaip22[$i] == null) {
                $nilaip22[$i] = 0;
            }
            if ($nilaip23[$i] == null) {
                $nilaip23[$i] = 0;
            }
            if ($nilaip24[$i] == null) {
                $nilaip24[$i] = 0;
            }
            $nilu1 += $bot2[$i]*$nilaip21[$i];
            $nilu2 += $bot2[$i]*$nilaip22[$i];
            $nilu3 += $bot2[$i]*$nilaip23[$i];
            $nilu4 += $bot2[$i]*$nilaip24[$i];
        }

        
        //ENDFETCH

        ob_end_clean();
        $pdf = new myPDF('l','mm','A4');

        $pdf->AddPage();
        $pdf->SetAutoPageBreak(false,1);
        $pdf->Image(url('assets/img/logo.png'),55,5);
        $pdf->SetFont('Times','B',14);
        $pdf->SetXY(145,40);
        $pdf->Cell(10,10,'LEMBAR REKAPITULASI NILAI TUGAS AKHIR',0,1,'C');

        $pdf->SetFont('Times','',12);
        $pdf->SetXY(30,45);
        $pdf->Cell(10,10,'Identitas Mahasiswa',0,1);

        $pdf->SetXY(30,55);
        $w = 30;
        $h = 5;
        $x = $pdf->GetX();
        $pdf->myCell($w,$h,$x,'Nama');
        $w = 5;
        $h = 5;
        $x = $pdf->GetX();
        $pdf->myCell($w,$h,$x,':');
        $w = 90;
        $h = 5;
        $x = $pdf->GetX();
        $pdf->myCell($w,$h,$x,$mhs->mhs);
        $w = 30;
        $h = 5;
        $x = $pdf->GetX();
        $pdf->myCell($w,$h,$x,"Jurusan");
        $w = 5;
        $h = 5;
        $x = $pdf->GetX();
        $pdf->myCell($w,$h,$x,':');
        $w = 100;
        $h = 5;
        $x = $pdf->GetX();
        $pdf->myCell($w,$h,$x,'Teknik Informatika');
        $pdf->Ln();
        
        $pdf->SetXY(30,60);
        $w = 30;
        $h = 5;
        $x = $pdf->GetX();
        $pdf->myCell($w,$h,$x,'NIM');
        $w = 5;
        $h = 5;
        $x = $pdf->GetX();
        $pdf->myCell($w,$h,$x,':');
        $w = 90;
        $h = 5;
        $x = $pdf->GetX();
        $pdf->myCell($w,$h,$x,$mhs->nim);
        $w = 30;
        $h = 5;
        $x = $pdf->GetX();
        $pdf->myCell($w,$h,$x,"Judul TA");
        $w = 5;
        $h = 5;
        $x = $pdf->GetX();
        $pdf->myCell($w,$h,$x,':');
        $w = 100;
        $h = 10;
        $x = $pdf->GetX();
        $pdf->myCell($w,$h,$x, $mhs->judul);
        $pdf->Ln();
        $pdf->Ln();
        
        //nilai akhir

        $na1 = (($nilp1+$nilp2)/2)*0.3;
        $na2 = (($nilu1+$nilu2)/2)*0.3;
        $na3 = (($nilu3+$nilu4)/2)*0.4;
        $pdf->SetFont('Times','B',12);
        $pdf->SetXY(90,80);
        $pdf->Cell(60,10,'Nama Dosen','1',0,'C',false);
        $pdf->Cell(30,10,'Jabatan','1',0,'C',false);

        $pdf->SetXY(30,70);
        $pdf->Cell(10,20,'No.','1',0,'C',false);
        $pdf->Cell(50,20,'Sumber Penilaian','1',0,'C',false);
        $pdf->Cell(90,10,'Tim Penilai','1',0,'C',false);
        $pdf->Cell(20,20,'Nilai','1',0,'C',false);
        $pdf->Cell(20,20,'Rerata','1',0,'C',false);
        $pdf->Cell(20,20,'Bobot','1',0,'C',false);
        $w = 20;
        $h = 20;
        $x = $pdf->GetX();
        $pdf->myCell2($w,$h,$x,'Nilai Akhir');
        $pdf->Ln();
        
        $pdf->SetFont('Times','',11);
        $pdf->SetXY(90,100);
        $pdf->Cell(60,10,$mhs->dospem2,'1',0,'',false);
        $pdf->SetXY(173,100);
        $pdf->Cell(7,10,'II','1',0,'C',false);
        $pdf->Cell(20,10,$nilp2,'1',0,'C',false);

        $pdf->SetXY(30,90);
        $pdf->Cell(10,20,'1','1',0,'C',false);
        $pdf->Cell(50,20,'Proses Pengerjaan TA','1',0,'',false);
        $pdf->Cell(60,10,$mhs->dospem1,'1',0,'',false);
        $pdf->Cell(23,20,'Pembimbing','1',0,'',false);
        $pdf->Cell(7,10,'I','1',0,'C',false);
        $pdf->Cell(20,10,$nilp1,'1',0,'C',false);//get Nil1
        $pdf->Cell(20,20,($nilp1+$nilp2)/2,'1',0,'C',false); //get (Nil1+Nil2)/2
        $pdf->Cell(20,20,'30%','1',0,'C',false); 
        $pdf->Cell(20,20,$na1,'1',0,'C',false); //get Rerata*0.3

        //Sidang
        $pdf->SetFont('Times','',11);
        $pdf->SetXY(90,120);
        $pdf->Cell(60,10,$mhs->dospem2,'1',0,'',false);
        $pdf->SetXY(173,120);
        $pdf->Cell(7,10,'II','1',0,'C',false);
        $pdf->Cell(20,10,$nilu2,'1',0,'C',false);

        $pdf->SetXY(30,110);
        $pdf->Cell(10,40,'2','1',0,'C',false);
        $pdf->Cell(50,40,'Sidang Tugas Akhir','1',0,'',false);
        $pdf->Cell(60,10,$mhs->dospem1,'1',0,'',false);
        $pdf->Cell(23,20,'Pembimbing','1',0,'',false);
        $pdf->Cell(7,10,'I','1',0,'C',false);
        $pdf->Cell(20,10,$nilu1,'1',0,'C',false);//get Nil1
        $pdf->Cell(20,20,($nilu1+$nilu2)/2,'1',0,'C',false); //get (Nil1+Nil2)/2
        $pdf->Cell(20,20,'40%','1',0,'C',false); 
        $pdf->Cell(20,20,$na2,'1',0,'C',false); //get Rerata*0.3

        //Penguji
        $pdf->SetXY(90,130);
        $pdf->Cell(60,10,$mhs->dospen1,'1',0,'',false);
        $pdf->Cell(23,20,'Penguji','1',0,'',false);

        $pdf->SetXY(173,130);
        $pdf->Cell(7,10,'I','1',0,'C',false);
        $pdf->Cell(20,10,$nilu3,'1',0,'C',false);
        $pdf->Cell(20,20,($nilu3+$nilu4)/2,'1',0,'C',false); //get (Nil1+Nil2)/2
        $pdf->Cell(20,20,'30%','1',0,'C',false); 
        $pdf->Cell(20,20,$na3,'1',0,'C',false); //get Rerata*0.3

        $pdf->SetXY(90,140);
        $pdf->Cell(60,10,$mhs->dospen2,'1',0,'',false);

        $pdf->SetXY(173,140);
        $pdf->Cell(7,10,'II','1',0,'C',false);
        $pdf->Cell(20,10,$nilu4,'1',0,'C',false);

        $pdf->SetXY(30,150);
        $pdf->SetFont('Times','B',11);
        $pdf->Cell(210,10,'Nilai Rerata Angka','1',0,'C',false);
        $pdf->Cell(20,10,$na1+$na2+$na3,'1',0,'C',false);

        $pdf->SetFont('Times','',12);
        $pdf->SetXY(200,158);
        Date::setLocale('id');
        $date = new Date(now());
        $pdf->Cell(30,10,'Pelaihari, '.$date->format('j F Y'),0,0,'C',false);
        $pdf->SetXY(35,163);
        $pdf->Cell(30,10,'Penanggung Jawab',0,0,'',false);
        $pdf->SetXY(35,168);
        $pdf->Cell(161,10,'Ketua Juruan Teknik Informatika',0,0,'',false);
        $pdf->Cell(30,10,'Ketua (Pembimbing I)',0,0,'',false);

        $pdf->SetXY(35,190);
        $pdf->Cell(161,10,'NIK. ',0,0,'',false);
        $pdf->Cell(30,10,'NIK. ',0,0,'',false);
        $pdf->SetFont('Times','BU',11);
        $pdf->SetXY(35,185);
        $pdf->Cell(161,10,'Agustian Noor, M.Kom',0,0,'',false);
        $pdf->Cell(30,10,$mhs->dospem1,0,0,'',false);
        
        return $pdf->Output('I','REKAP_'.$mhs->nim.'.pdf');

        // return $nilaiM;
    }
}

Class myPDF extends FPDF{
    function myCell($w,$h,$x,$t){
        $height = $h/3;
        $first = $height+2;
        $second = $height+$height+$height+3;
        $thrird = $height+$height+$height+$height+$height+4;
        $len = strlen($t);
        if ($len > 40) {
          $txt = str_split($t,40);
          $this->SetX($x);
          $this->Cell($w, $first,$txt[0],'','','');
          $this->SetX($x);
          $this->Cell($w,$second,$txt[1],'','','');
          $this->SetX($x);
          $this->Cell($w,$thrird,$txt[2],'','','');
          $this->SetX($x);
          $this->Cell($w,$h,'',0,0,'L',0);
        }else{
          $this->SetX($x);
          $this->Cell($w,$h,$t,0,0,'L',0);
        }
      }
    function myCell2($w,$h,$x,$t){
        $height = $h/3;
        $first = $height+2;
        $second = $height+$height+$height+3;
        $thrird = $height+$height+$height+$height+$height+4;
        $len = strlen($t);
        if ($len > 6) {
          $txt = str_split($t,6);
          $this->SetX($x);
          $this->Cell($w, $first,$txt[0],'','','C','');
          $this->SetX($x);
          $this->Cell($w,$second,$txt[1],'','','C','');
          $this->SetX($x);
          $this->Cell($w,$h,'',1,0,'C',0);
        }else{
          $this->SetX($x);
          $this->Cell($w,$h,$t,1,0,'C',0);
        }
      }
}
