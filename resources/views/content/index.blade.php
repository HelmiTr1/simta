@extends('layouts.app')

@section('title')
    Data Content
@endsection
@section('bread')
    {{Breadcrumbs::render('cont')}}
@endsection
@section('content')
<div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Data Content</h3>
            </div>
            <div class="col text-right">
            <a href="{{url('content/create')}}" class="btn btn-sm btn-primary">Tambah Content</a>
            </div>
          </div>
        </div>
        @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
        <div class="">
            
          <!-- Projects table -->
          <table id="content1" class="table table-responsive align-items-center table-flush table-hover">
            <thead class="thead-light">
              <tr>
                <th scope="col">Action</th>
                <th scope="col">Judul</th>
                <th scope="col">Isi</th>
                <th scope="col">URL</th>
                <th scope="col">Icon</th>
                <th scope="col">Hak Akses</th>
                <th scope="col">Menu</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($content as $content)
              <tr>
                <td>
                <a href="{{url('content').'/'.$content->id.'/edit'}}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{url('content').'/'.$content->id}}" method="post" class="d-inline" id="hapus-btn{{$content->id}}">
                  @method('delete')
                  @csrf
                </form>
                <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDelete({{$content->id}})">Delete</button>
                </td>
                  <td>{{$content->judul}}</td>
                  <td>{{$content->isi}}</td>
                  <td class="text-wrap">{{$content->url}}</td>
                  <td><i class="{{$content->icon}}" data-toggle="tooltip" data-placement="top" title="{{$content->icon}}"></i></td>
                  <td class="text-wrap">{{$content->level->level}}</td>
                  <td class="text-wrap">{{$content->menu->menu}}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>
@endsection

@section('footer')
<script>
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
<link rel="stylesheet" href="{{url('assets/vendor/datatables.net-buttons-bs4/css/buttons.dataTables.min.css')}}">
<link rel="stylesheet" href="{{url('assets/vendor/datatables.net-responsive-bs4/css/responsive.dataTables.min.css')}}">
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="{{url('assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('assets/vendor/datatables.net-responsive-bs4/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{url('assets/vendor/datatables.net-buttons-bs4/js/buttons.dataTables.min.js')}}"></script>

    <script>
        $(document).ready(function(){
          var table = $('table').DataTable({
            "order": [[ 2, "desc" ],[ 3, "asc" ]],
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