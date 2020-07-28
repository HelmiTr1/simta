<?php

namespace App\Http\Controllers;

use App\Bimbingan;
use App\Dosen;
use App\Jadwal;
use App\Ruangan;
use App\Waktusidang;
use Illuminate\Http\Request;

class AlgorithmController extends Controller
{
    private $batch;
    private $populasi;
    private $crossover;
    private $mutasi;

    private $mhs = array();
    private $individu = array(array(array()));
    private $dospem = array();
    private $dospem2 = array();
    private $dospen = array();
    private $dospen2 = array();
    private $jamsidang = array();
    private $ruangan = array();

    private $induk = array();

    public function __construct( $batch, $populasi, $crossover, $mutasi) {
        $this->batch = $batch;
        $this->populasi = $populasi;
        $this->crossover = $crossover;
        $this->mutasi = $mutasi;
    }

    public function GetData()
    {
        $data_jadwal = Jadwal::get()->where('row_status','1');
        $jad_count = count($data_jadwal);
        if ($jad_count != 0) {
            foreach ($data_jadwal as $data) {
                $data_mhs = Bimbingan::get()->where('row_status','1')->where('id','!=',$data->id_bimbingan);
        
                $i=0;
        
                foreach ($data_mhs as $data) {
                    $this->mhs[$i] = $data->id;
                    $this->dospem[$i] = $data->dospem1;
                    $this->dospem2[$i] = $data->dospem2;
                    $data_dosen = Dosen::get()->where('row_status','1')->where('nidn','!=',$this->dospem[$i])->where('nidn','!=',$this->dospem2[$i]);
                    $j=0;
                    foreach ($data_dosen as $data ) {
                        $this->dospen[$j] = $data->nidn;
                        // $i++;
                        $data_dosen2 = Dosen::get()->where('row_status','1')->where('nidn','!=',$this->dospem[$i])->where('nidn','!=',$this->dospem2[$i])->where('nidn','!=',$this->dospen[$j]);
                        $k=0;
                        foreach ($data_dosen2 as $data ) {
                            $this->dospen2[$k] = $data->nidn;
                            $k++;
                        }
                        $j++;
        
                    }
                    $i++;
                }
    
            }
        }else{
            $data_mhs = Bimbingan::get()->where('row_status','1');
        
            $i=0;
    
            foreach ($data_mhs as $data) {
                $this->mhs[$i] = $data->id;
                $this->dospem[$i] = $data->dospem1;
                $this->dospem2[$i] = $data->dospem2;
                $data_dosen = Dosen::get()->where('row_status','1')->where('nidn','!=',$this->dospem[$i])->where('nidn','!=',$this->dospem2[$i]);
                $j=0;
                foreach ($data_dosen as $data ) {
                    $this->dospen[$j] = $data->nidn;
                    // $i++;
                    $data_dosen2 = Dosen::get()->where('row_status','1')->where('nidn','!=',$this->dospem[$i])->where('nidn','!=',$this->dospem2[$i])->where('nidn','!=',$this->dospen[$j]);
                    $k=0;
                    foreach ($data_dosen2 as $data ) {
                        $this->dospen2[$k] = $data->nidn;
                        $k++;
                    }
                    $j++;
    
                }
                $i++;
            }
        }

        $data_waktusidang = Waktusidang::get()->where('row_status','1')->where('status','1');
        $i=0;
        foreach ($data_waktusidang as $data ) {
            $this->jamsidang[$i] = $data->id;
            $i++;
        }

        $data_ruangan = Ruangan::get()->where('row_status','1');
        $i=0;
        foreach ($data_ruangan as $data ) {
            $this->ruangan[$i] = $data->id;
            $i++;
        }
    }

    public function inisialisasi()
    {
        $jam_count = count($this->jamsidang);
        $jam_count = count($this->jamsidang);
        $dospen1_count = count($this->dospen);
        $dospen2_count = count($this->dospen2);
        $ruangan_count = count($this->ruangan);

        for ($i=0; $i < $this->populasi; $i++) { 
            for ($j=0; $j < $jam_count; $j++) { 
                $this->individu[$i][$j][0] = $j;
                
                // $this->individu[$i][$j][1] = mt_rand(0,($jam_count-1));
                $this->individu[$i][$j][1] = mt_rand(0,($dospen1_count-1));
                $this->individu[$i][$j][2] = mt_rand(0,($dospen2_count-1));
                $this->individu[$i][$j][3] = mt_rand(0,($ruangan_count-1));
            }
        }
        return $this->individu;
    }

    public function CekFitness($ind)
    {
        $pinalty = 0;
        $jam_count = count($this->jamsidang);

        for ($i=0; $i < $jam_count; $i++) { 
            // $jam_1 = intval($this->individu[$ind][$i][1]);
            $dospen1_1 = intval($this->individu[$ind][$i][1]);
            $dospen2_1 = intval($this->individu[$ind][$i][2]);
            $ruangan_1 = intval($this->individu[$ind][$i][3]);
            for ($j = 0; $j < $jam_count; $j++) { 
                // $jam_2 = intval($this->individu[$ind][$j][1]);
                $dospen1_2 = intval($this->individu[$ind][$j][1]);
                $dospen2_2 = intval($this->individu[$ind][$j][2]);
                $ruangan_2 = intval($this->individu[$ind][$j][3]);

                if ($i == $j)
                    continue;
                
                    if ($dospen1_1 == $dospen1_2 &&
                        $dospen2_1 == $dospen2_2 &&
                        $dospen1_1 == $dospen2_1 &&
                        $dospen1_2 == $dospen2_2 &&
                        $dospen1_1 == $dospen2_2 &&
                        $ruangan_1 == $ruangan_2 ) {
                        $pinalty +=1;
                    }
            }
        }
        $fitness = floatval(1 / (1 + $pinalty));
        return $fitness;
    }
    public function HitungFitness()
    {
        
        $fitness = array();
        
        for ($indv = 0; $indv < $this->populasi; $indv++)
        {            
            $fitness[$indv] = $this->CekFitness($indv);            
        }
        
        return $fitness;
    }

    public function Seleksi($fitness)
    {
        $jumlah = 0;
        $rank   = array();

        for ($i=0; $i < $this->populasi; $i++) { 
            $rank[$i] = 1;
            for ($j = 0; $j < $this->populasi; $j++)
            {
                $fitnessA = floatval($fitness[$i]);
                $fitnessB = floatval($fitness[$j]);

                if ( $fitnessA > $fitnessB)
                {
                    $rank[$i] += 1;                    
                }
            }
            $jumlah += $rank[$i];
        }

        $jumlah_rank = count($rank);
        for ($i = 0; $i < $this->populasi; $i++)
        {
            
            $target = mt_rand(0, $jumlah - 1);           
          
            $cek    = 0;
            for ($j = 0; $j < $jumlah_rank; $j++) {
                $cek += $rank[$j];
                if (intval($cek) >= intval($target)) {
                    $this->induk[$i] = $j;
                    break;
                }
            }
        }
        // return $jumlah_rank;
    }

    public function Crossover()
    {
        $individu_baru = array(array(array()));
        $jam_count = count($this->jamsidang);

        for ($i = 0; $i < $this->populasi; $i += 2)
        {
            $b = 0;
            
            $cr = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();

            if (floatval($cr) < floatval($this->crossover)) {
                $a = mt_rand(0, $jam_count - 2);
                while ($b <= $a) {
                    $b = mt_rand(0, $jam_count - 1);
                }
                for ($j = 0; $j < $a; $j++) {
                    for ($k = 0; $k < 4; $k++) {                        
                        $individu_baru[$i][$j][$k]     = $this->individu[$this->induk[$i]][$j][$k];
                    }
                }
                for ($j = $a; $j < $b; $j++) {
                    for ($k = 0; $k < 4; $k++) {
                        $individu_baru[$i][$j][$k]     = $this->individu[$this->induk[$i]][$j][$k];
                    }
                }
                for ($j = $b; $j < $jam_count; $j++) {
                    for ($k = 0; $k < 4; $k++) {
                        $individu_baru[$i][$j][$k]     = $this->individu[$this->induk[$i]][$j][$k];
                    }
                }
            }else{
                for ($j = 0; $j < $jam_count; $j++) {
                    for ($k = 0; $k < 4; $k++) {
                        $individu_baru[$i][$j][$k]     = $this->individu[$this->induk[$i]][$j][$k];
                    }
                }
            }
        }
        $jam_count = count($this->jamsidang);
        
        for ($i = 0; $i < $this->populasi; $i += 2) {
          for ($j = 0; $j < $jam_count ; $j++) {
            for ($k = 0; $k < 4; $k++) {
                $this->individu[$i][$j][$k] = $individu_baru[$i][$j][$k];
                // $this->individu[$i + 1][$j][$k] = $individu_baru[$i + 1][$j][$k];
            }
          }
        }

        // return $this->individu;
    }

    public function Mutasi()
    {
        $fitness = array();
        $r       = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();

        $jam_count = count($this->jamsidang);
        // $jam_count = count($this->jamsidang);
        $dospen1_count = count($this->dospen);
        $dospen2_count = count($this->dospen2);
        $ruangan_count = count($this->ruangan);

        for ($i = 0; $i < $this->populasi; $i++) {
            if ($r < $this->mutasi) {
                $krom = mt_rand(0,($jam_count-1));
                // $this->individu[$i][$krom][1] = mt_rand(0, $jam_count - 1);
                $this->individu[$i][$krom][1] = mt_rand(0, $dospen1_count - 1);
                $this->individu[$i][$krom][2] = mt_rand(0, $dospen2_count - 1);
                $this->individu[$i][$krom][3] = mt_rand(0, $ruangan_count - 1);
            }
            $fitness[$i] = $this->CekFitness($i);
        }
        return $fitness;
    }

    public function GetIndividu($indv)
    {
        
        $individu_solusi = array(array());
        
        for ($j = 0; $j < count($this->jamsidang); $j++)
        {
            $individu_solusi[$j][0] = intval($this->mhs[$this->individu[$indv][$j][0]]);
            $individu_solusi[$j][1] = intval($this->jamsidang[$j]);
            $individu_solusi[$j][2] = intval($this->ruangan[$this->individu[$indv][$j][3]]);          
            $individu_solusi[$j][3] = intval($this->dospen[$this->individu[$indv][$j][1]]);         
            $individu_solusi[$j][4] = intval($this->dospen2[$this->individu[$indv][$j][2]]);         
        }
        
        return $individu_solusi;
    }
}
