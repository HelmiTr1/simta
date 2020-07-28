@extends('layouts.app')

@section('title')
    Berkas Revisi
@endsection
@section('bread')
{{ Breadcrumbs::render('revisi') }}
@endsection
@section('content')

<div class="row">
  {{-- start region --}}
  @if($params =='terima')
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Data revisi diterima</h3>
            </div>
          </div>
        </div>

        {{session()->get('revisiname')}}
        @if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
@endif
        <div class="table-responsive">
            
          <!-- Projects table -->
          <table id="revisi1" class="table align-items-center table-flush table-hover">
            <thead class="thead-light">
              <tr>
                <th scope="col">Action</th>
                <th scope="col">NIM</th>
                <th scope="col">Nama</th>
                <th scope="col">Filename</th>
                <th scope="col">Tanggal Upload</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($revisi1 as $r1)
              <tr>
                <td>
                  <form action="{{url('berkas/revisi').'/'.$r1->id}}" method="post" class="d-inline" id="tolak-btn{{$r1->id}}">
                    @method('patch')
                    @csrf
                  </form>
                  <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Tolak" onclick="confirmDelete1({{$r1->id}})"><i class="fas fa-fw fa-ban"></i> Tolak</button>
                </td>
                <td>
                  {{$r1->nim}}
                      </td>
                      <td>
                          {{$r1->mahasiswa->nama}}
                      </td>
                      <td>
                      <a href="{{url('berkas/revisi').'/'.$r1->id}}" target="_blank"><i class="ni ni-single-copy-04 text-xl"></i> {{$r1->filename}}</a>
                      </td>
                      <?php
                      Date::setLocale('id');
                      $date = new Date($r1->input_at);
                      ?>
                  <td>{{$date->format('j F Y')}}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endif
    {{-- endregion --}}
    @if($params =='tolak')
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0 text-danger text-uppercase">Data revisi ditolak</h3>
            </div>
          </div>
        </div>
        @if (session('status1'))
    <div class="alert alert-success">
        {{ session('status1') }}
    </div>
@endif
        <div class="table-responsive">
            
          <!-- Projects table -->
          <table id="revisi2" class="table align-items-center table-flush table-hover">
            <thead class="thead-light">
              <tr>
                <th scope="col">Action</th>
                <th scope="col">NIM</th>
                <th scope="col">Nama</th>
                <th scope="col">Filename</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($revisi2 as $r2)
                <tr>
                <td>
                  <form action="{{url('berkas/revisi').'/'.$r2->id}}" method="post" class="d-inline" id="hapus-btn{{$r2->id}}">
                    @method('delete')
                    @csrf
                  </form>
                  <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" onclick="confirmDelete({{$r2->id}})"><i class="fas fa-fw fa-trash"></i></button>
                </td>
                    <td>
                        {{$r2->nim}}
                    </td>
                    <td>
                        {{$r2->mahasiswa->nama}}
                    </td>
                    <td>
                      <a href="{{url('berkas/revisi').'/'.$r2->id}}" target="_blank" data-toggle="tooltip" data-placement="top" data-title="Preview"><i class="ni ni-single-copy-04 text-xl"></i> {{$r2->filename}}</a>
                      </td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endif
</div>
@endsection

@section('footer')
<script>
  function confirmDelete1(id) {
            Swal.fire({
                 title: 'Apakah Anda Yakin?',
                  text: "Anda menolak laporan berkas revisi.",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Tolak'
            })
                .then((willDelete) => {
                    if (willDelete.value) {
                        $('#tolak-btn'+id).submit();
                    } else {
                      Swal.fire({
                        icon: 'warning',
                        title: 'Cancelled',
                        text: 'Data tidak ditolak!'
                      })
                    }
                });
        }
  function confirmDelete(id) {
            Swal.fire({
                 title: 'Apakah Anda Yakin?',
                  text: "Anda Tidak Akan Dapat Mengembalikannya!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
            })
                .then((willDelete) => {
                    if (willDelete.value) {
                        $('#hapus-btn'+id).submit();
                    } else {
                      Swal.fire({
                        icon: 'error',
                        title: 'Cancelled',
                        text: 'Data tidak dihapus!'
                      })
                    }
                });
        }
</script>
<link rel="stylesheet" href="{{url('assets/vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{url('assets/vendor/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="{{url('assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('assets/vendor/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#revisi1').DataTable({
              "language": {
            "paginate": {
              "previous": "<i class='fas fa-angle-left'></i>",
              "next": "<i class='fas fa-angle-right'></i>",
              "first": "<i class='fas fa-angle-double-left'></i>",
              "last": "<i class='fas fa-angle-double-right'></i>"
                }
          }
            })
            $('#revisi2').DataTable({
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