@extends('layouts.app')

@section('bread')
{{ Breadcrumbs::render('nilai') }}
@endsection

@section('title')
    Rekapitulasi Nilai TA
@endsection
@php
    $jadwal = DB::table('tb_jadwalsidang')->get();
@endphp
@if ($jadwal->count()==0)
@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body text-center">
        Jadwal belum di<i>generate</i>. Silahkan hubungi admin.
        </div>
      </div>
    </div>
  </div>
  @endsection
@else
@if(Request::get('id')==null)
@section('content')
    <div class="row">
    <div class="col-xl-6">
        <div class="card">
        <div class="card-header border-0">
            <h3 class="h3">Nilai Sidang</h3>
        </div>
        <div class="table-responsive">
            
            <!-- Projects table -->
            <table id="nilai1" class="table align-items-center table-flush table-hover">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Action</th>
                  <th scope="col">Mahasiswa</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($mhs2 as $data)
                    <tr>
                    <td>
                      <a href="{{url('sidang/nilai/rekap').'?id='.$data->nim}}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"> <i class="fas fa-fw fa-eye"></i></a>
                      <a href="{{url('sidang/nilai/cetak').'?id='.$data->nim}}" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Cetak" target="_blank"> <i class="fas fa-fw fa-print"></i></a>
                    </td>
                    <td>{{$data->nama}}</td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

    </div>
    </div>
@endsection
@else
@section('content')

<div class="row">
  <div class="col-xl-6">
    <div class="card card-stats">
            @php
                $mhsa = DB::table('tb_mahasiswa')->where('row_status','1')->where('nim',$nim)->first();
            @endphp
      <div class="card-body mt-0">
        <div class="row">
          <div class="col">
          <h5 class="card-title text-uppercase text-muted mb-0">{{__('Penilaian')}}</h5>
          <span class="h2 font-weight-bold mb-0">Nilai Proses Pengerjaan TA</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
            <i class="ni ni-paper-diploma"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-sm">
        <span class="text-wrap font-weight-bold">{{$mhsa->nama}}</span>
        </p>
      <div class="mt-3 mb-0 text-sm">
        <div class="accordion" id="accordionExample">
        <?php $x=0; ?>
        @foreach ($dosenp as $data)
        <?php $dosenM = DB::table('tb_dosen')->where('nidn',$dosenp[$x])->get();?>
        @foreach ($dosenM as $data)
          <div class="card card-sm card-body shadow-sm border-soft">
              <a href="#accordion-panel-{{$x}}" data-target="#accordion-panel-{{$x}}" class="accordion-panel-header"
                  data-toggle="collapse" role="button" aria-expanded="false"
                  aria-controls="accordion-panel-{{$x}}">
                  <span class="h4 mb-0 font-weight-bold">{{$data->nama}}</span>
                  <span class="float-right"><i class="fas fa-plus"></i></span>
              </a>
              <div class="collapse" id="accordion-panel-{{$x}}">
                  <div class="pt-3">
                      <p class="mb-0">
                        <?php $bimbinganM = DB::table('tb_bimbingan')->where('nim',$nim)->get()->first();?>
                        <ul class="list-group list-group-flush">
                          <?php $j=0; $tot=array();?>
                          @foreach ($aspekNilai2 as $data)
                          <?php $nilaiM = DB::table('tb_nilaisidang')->where('id_dosen',$dosen[$x])->where('id_aspeknilai',$data->id)->where('id_bimbingan',$bimbinganM->id)->get(); ?>
                          <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{$data->aspeknilai}}
                            @if (count($nilaiM)==0)
                            <span >{{__('0')}}</span>
                            @endif
                            @foreach ($nilaiM as $nil)
                            <?php $tot[$j]= $nil->nilai;  ?>
                              <span >{{$nil->nilai}}</span>
                              @endforeach
                              </li>
                              <?php
                              $bot[$j]= $data->bobot/100;
                              $j++; 
                              ?>
                          @endforeach
                          <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                            Total
                          <span><?php 
                          if(count($tot)==0){
                            ?>
                            {{__('0')}}
                            <?php
                          }else{
                            $bot2 = 0;
                            for ($i=0; $i < count($aspekNilai2); $i++) { 
                              $bot2 += $bot[$i]*$tot[$i];
                            }
                            ?>
                            {{$bot2}}
                            <?php
                          }
                          ?></span>
                          </li>
                        </ul>
                      </p>
                  </div>
              </div>
          </div>
          @endforeach
          <?php $x++; ?>
          @endforeach
        </div>
        </div>
        
      </div>
      </div>
      </div>

  <div class="col-xl-6">
    <div class="card card-stats">
            @php
                $mhsa = DB::table('tb_mahasiswa')->where('row_status','1')->where('nim',$nim)->first();
            @endphp
      <div class="card-body mt-0">
        <div class="row">
          <div class="col">
          <h5 class="card-title text-uppercase text-muted mb-0">{{__('Penilaian')}}</h5>
          <span class="h2 font-weight-bold mb-0">Nilai Sidang TA</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
            <i class="ni ni-paper-diploma"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0 text-sm">
        <span class="text-wrap font-weight-bold">{{$mhsa->nama}}</span>
        </p>
      <div class="mt-3 mb-0 text-sm">
        <div class="accordion" id="accordionExample2">
          <?php $x=0; ?>
        @foreach ($dosen as $data)
        <?php $dosenM = DB::table('tb_dosen')->where('nidn',$dosen[$x])->get();?>
        @foreach ($dosenM as $data)

          <div class="card card-sm card-body shadow-sm border-soft">
          <a href="#accordion-panel-{{$x}}1" data-target="#accordion-panel-{{$x}}1" class="accordion-panel-header"
                  data-toggle="collapse" role="button" aria-expanded="false"
                  aria-controls="accordion-panel-{{$x}}1">
                  <span class="h4 mb-0 font-weight-bold">{{$data->nama}}</span>
                  <span class="float-right"><i class="fas fa-plus"></i></span>
              </a>
              <div class="collapse" id="accordion-panel-{{$x}}1">
                  <div class="pt-3">
                      <p class="mb-0">
                        <?php $bimbinganM = DB::table('tb_bimbingan')->where('nim',$nim)->get()->first();?>
              <ul class="list-group list-group-flush">
                <?php $j=0; $tot=array();?>
                @foreach ($aspekNilai as $data)
                <?php $nilaiM = DB::table('tb_nilaisidang')->where('id_dosen',$dosen[$x])->where('id_aspeknilai',$data->id)->where('id_bimbingan',$bimbinganM->id)->get(); ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  {{$data->aspeknilai}}
                  @if (count($nilaiM)==0)
                  <span >{{__('0')}}</span>
                  @endif
                  @foreach ($nilaiM as $nil)
                  <?php $tot[$j]= $nil->nilai;  ?>
                    <span >{{$nil->nilai}}</span>
                    @endforeach
                    </li>
                    <?php
                    $bot[$j]= $data->bobot/100;
                    $j++; 
                    ?>
                @endforeach
                <li class="list-group-item d-flex justify-content-between align-items-center font-weight-bold">
                  Total
                <span><?php 
                if(count($tot)==0){
                  ?>
                  {{__('0')}}
                  <?php
                }else{
                  $bot2 = 0;
                  for ($i=0; $i < count($aspekNilai); $i++) { 
                    $bot2 += $bot[$i]*$tot[$i];
                  }
                  ?>
                  {{$bot2}}
                  <?php
                }
                ?></span>
                </li>
              </ul>
                      </p>
                  </div>
              </div>
          </div>
          @endforeach
        <?php $x++; ?>
        @endforeach
        </div>
        
        
      </div>
      </div>
      </div>
    </div>

@endsection
@endif
@endif
@section('footer')

<link rel="stylesheet" href="{{url('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('assets/vendor/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="{{url('assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('assets/vendor/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#nilai1').DataTable({
              "language": {
            "paginate": {
              "previous": "<i class='fas fa-angle-left'></i>",
              "next": "<i class='fas fa-angle-right'></i>",
              "first": "<i class='fas fa-angle-double-left'></i>",
              "last": "<i class='fas fa-angle-double-right'></i>"
                }
          }
            })
        });
        </script>
@endsection