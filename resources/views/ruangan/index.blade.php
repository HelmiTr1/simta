@extends('layouts.app')
@section('title')
    Data Ruangan
@endsection
@section('bread')
{{ Breadcrumbs::render('ruangan') }}
@endsection
@section('content')
<div class="row">
    <div class="col-xl-8">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Data Ruangan</h3>
            </div>
            <div class="col text-right">
              <a href="{{url('sidang/ruangan/create')}}" class="btn btn-sm btn-primary">Tambah Ruangan</a>
              </div>
          </div>
        </div>

        <div class="table-responsive">
            
          <!-- Projects table -->
          <table id="ruangan1" class="table align-items-center table-flush table-hover">
            <thead class="thead-light">
              <tr>
                <th scope="col">Action</th>
                <th scope="col">Kode Ruangan</th>
                <th scope="col">Ruangan</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($ruangan as $r)
                    <tr>
                      <td>
                        <a href="{{url('sidang/ruangan').'/'.$r->id.'/edit'}}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-fw fa-edit"></i></a>
                      <form action="{{url('sidang/ruangan').'/'.$r->id}}" method="post" class="d-inline" id="hapus-btn{{$r->id}}">
                          @method('delete')
                          @csrf
                        </form>
                        <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="Delete" onclick="confirmDelete({{$r->id}})"><i class="fas fa-fw fa-trash"></i></button>
                      </td>
                      <td>
                        {{$r->kode_ruangan}}
                      </td>
                      <td>
                        {{$r->nama_ruangan}}
                      </td>
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
        $('#ruangan1').DataTable({
          "language": {
            "paginate": {
              "previous": "<i class='fas fa-angle-left'></i>",
              "next": "<i class='fas fa-angle-right'></i>",
              "first": "<i class='fas fa-angle-double-left'></i>",
              "last": "<i class='fas fa-angle-double-right'></i>"
                }
          }
        });
        
    })
    </script>
@endsection

