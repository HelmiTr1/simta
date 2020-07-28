@extends('layouts.app')

@section('title')
    Data Menu
@endsection
@section('bread')
    {{Breadcrumbs::render('menu')}}
@endsection
@section('content')
<div class="row">
    <div class="col-xl-8">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Data Menu</h3>
            </div>
            <div class="col text-right">
            <a href="{{url('menu/create')}}" class="btn btn-sm btn-primary">Tambah Menu</a>
            </div>
          </div>
        </div>
        @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
        <div class="table-responsive">
            
          <!-- Projects table -->
          <table id="menu1" class="table align-items-center table-flush table-hover">
            <thead class="thead-light">
              <tr>
                <th scope="col">Action</th>
                <th scope="col">Menu</th>
                <th scope="col">URL</th>
                <th scope="col">Icon</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($menu as $menu)
                  <tr>
                    <td>
                    <a href="{{url('menu').'/'.$menu->id.'/edit'}}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{url('menu').'/'.$menu->id}}" method="post" class="d-inline" id="hapus-btn{{$menu->id}}">
                      @method('delete')
                      @csrf
                    </form>
                    <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDelete({{$menu->id}})">Delete</button>
                    </td>
                  <td>{{$menu->menu}}</td>
                  <td class="text-wrap">{{$menu->url}}</td>
                  <td><i class="{{$menu->icon}}" data-toggle="tooltip" data-placement="top" title="{{$menu->icon}}"></i></td>
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
<link rel="stylesheet" href="{{url('assets/vendor/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}">
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> --}}
    <script src="{{url('assets/vendor/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{url('assets/vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{url('assets/vendor/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('#menu1').DataTable({
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