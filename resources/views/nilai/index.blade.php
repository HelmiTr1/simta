@extends('layouts.app')

@section('bread')
{{ Breadcrumbs::render('nilai') }}
@endsection

@section('title')
    Nilai Sidang
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
@section('content')
    <div class="row">
    <div class="col-xl-12">
        <div class="card">
        <div class="card-header border-0">
            {{-- <h3 class="h3">Nilai Sidang</h3> --}}
        </div>
        @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
        @if (session('edit'))
        <div class="alert alert-warning">
            {{ session('edit') }}
        </div>
    @endif
        <div class="table-responsive">
            
            <!-- Projects table -->
            <table id="nilai1" class="table align-items-center table-flush table-hover">
              <thead class="thead-light">
                <tr>
                  <th scope="col">NIM</th>
                  <th scope="col">Mahasiswa</th>
                  <th scope="col">Nilai Sidang TA</th>
                  <th scope="col">Nilai Proses Pengerjaan TA</th>
                </tr>
              </thead>
              <tbody>
                @php
                      $i=0;
                @endphp
                @foreach ($dosen as $data)
                    <tr>
                    <td>{{$data->nim}}</td>
                    <td>{{$data->mhs}}</td>
                    <td>
                      <?php
                    if (count($nilais[$i]) == 0) {
                      ?>
                      <a href="{{url('sidang/nilai/create').'?id='.$data->nim.'&&p=s'}}" class="btn btn-danger btn-sm">Nilai</a>
                    <?php
                    }else{?>
                    <a href="{{url('sidang/nilai').'/'.$data->nim.'/edit?p=s'}}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{url('sidang/nilai').'/'.$data->nim.'/edit?p=s&&d=detail'}}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-fw fa-eye"></i></a>
                    <?php
                    }?>
                    </td>
                    <td>
                    @if ($data->dosenp1 == Auth::user()->username || $data->dosenp2 == Auth::user()->username)
                    <?php
                    if (count($nilaip[$i]) == 0) {
                      ?>
                      <a href="{{url('sidang/nilai/create').'?id='.$data->nim.'&&p=p'}}" class="btn btn-danger btn-sm">Nilai</a>
                    <?php
                    }else{?>
                    <a href="{{url('sidang/nilai').'/'.$data->nim.'/edit?p=p'}}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{url('sidang/nilai').'/'.$data->nim.'/edit?p=p&&d=detail'}}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail"><i class="fas fa-fw fa-eye"></i></a>
                    <?php
                    }?>
                    @endif
                    </td>
                    </tr>
                    @php
                        $i++;
                    @endphp
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

    </div>
    </div>
@endsection
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
            });
        });
        </script>
@endsection