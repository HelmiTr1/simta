@extends('layouts.app')

@section('title')
    Result Jadwal
@endsection
@section('bread')
{{ Breadcrumbs::render('jadwal') }}
@endsection
@section('content')
<div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Daftar Jadwal</h3>
            </div>
          </div>
          @if (session('status'))
          <div class="alert alert-success">
              {{ session('status') }}
          </div>
      @endif
        </div>
        <div class="">
            
          <!-- Projects table -->
          <table id="jadwal1" class="table table-responsive align-items-center table-flush table-hover">
            <thead class="thead-light">
              <tr>
                <th scope="col">Action</th>
                {{-- <th scope="col">Tanggal</th> --}}
                <th scope="col">Hari</th>
                <th scope="col">Jam</th>
                <th scope="col">Ruangan</th>
                <th scope="col">Mahasiswa</th>
                <th scope="col">Dosen Pembimbing 1</th>
                <th scope="col">Dosen Pembimbing 2</th>
                <th scope="col">Dosen Penguji 1</th>
                <th scope="col">Dosen Penguji 2</th>
                <th scope="col">Batch</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($jadwal as $j)
                  <tr>
                    <td>
                    <a href="" class="btn btn-warning btn-sm edit" data-toggle="modal" data-target="#myModal" data-id="{{$j->id}}" data-dosen1={{$j->dosen1}} data-dosen2={{$j->dosen2}}><span data-toggle="tooltip" data-placement="top" data-title="Edit Penguji"><i class="fas fa-fw fa-edit"></i></span></a>
                    </td>
                    {{-- <?php
                      Date::setLocale('id');
                      $date = new Date($j->tanggal);
                      ?>
                  <td>{{$date->format('j F Y')}}</td> --}}
                  <td>{{$j->hari}}</td>
                  <td class="text-center">{{$j->waktu}}</td>
                  <td>{{$j->kode_ruangan.' - '.$j->ruangan}}</td>
                  <td>{{$j->mhs}}</td>
                  <td class="@if($j->dospem1==$j->dospem2||$j->dospem1==$j->dospen1|| $j->dospem1==$j->dospen2) bg-danger text-white @endif">{{$j->dospem1}}</td>
                  <td class="@if($j->dospem2==$j->dospem1||$j->dospem2==$j->dospen1|| $j->dospem2==$j->dospen2) bg-danger text-white @endif">{{$j->dospem2}}</td>
                  <td class="@if($j->dospen1==$j->dospem1||$j->dospen1==$j->dospen2|| $j->dospen1==$j->dospem2) bg-danger text-white @endif">{{$j->dospen1}}</td>
                  <td class="@if($j->dospen2==$j->dospem1||$j->dospen2==$j->dospen1|| $j->dospen2==$j->dospem2) bg-danger text-white @endif">{{$j->dospen2}}</td>
                  <td class="text-center">{{$j->batch}}</td>
                </tr>
              @endforeach
            </tbody>
            
          </table>
        </div>
      </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Dosen Penguji</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    <form action="{{url('/')}}" method="POST">
      <div class="modal-body">
          @csrf
          @method('patch')
          <div class="form-group row">
            <label for="input3" class="col-sm-3 col-form-label col-form-label-sm">Dosen Penguji 1</label>
            <div class="col-sm-9">
              <select name="dospen1" id="dospen1" class="form-control form-control-sm">
                @foreach ($dospen1 as $data )
                    <option value="{{$data->nidn}}">{{$data->nama}}</option>;
                  @endforeach
              </select>
          </div>
          </div>
          <div class="form-group row">
            <label for="input3" class="col-sm-3 col-form-label col-form-label-sm">Dosen Penguji 2</label>
            <div class="col-sm-9">
              <select name="dospen2" id="dospen2" class="form-control form-control-sm">
                
                  @foreach ($dospen2 as $data )
                    <option value="{{$data->nidn}}">{{$data->nama}}</option>;
                  @endforeach
              </select>
          </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('footer')

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
            "order": [[ 1, "desc" ],[ 2, "asc" ]],
            "language": {
            "paginate": {
              "previous": "<i class='fas fa-angle-left'></i>",
              "next": "<i class='fas fa-angle-right'></i>",
              "first": "<i class='fas fa-angle-double-left'></i>",
              "last": "<i class='fas fa-angle-double-right'></i>"
                }
          },
            buttons: [
            'copy', 'excel', 'pdf'
          ]
          });
          
          $('table').on("click",".edit",function(e) {
            e.preventDefault();
            // console.log(e);
            var id = $(this).data('id');
            var dosen1 = $(this).data('dosen1');
            var dosen2 = $(this).data('dosen2');
              console.log(dosen1);
            // console.log(d);
            // var name = $(this).data('name');
            // var parentId = $(this).data('parent-id');
            // var maxScore = $(this).data('max-score');
            var url = "{{ url('sidang/jadwal') }}/" + id;

            $('#myModal form').attr('action', url);
            $('#myModal form select[name="dospen1"]').val(dosen1).change();
            $('#myModal form select[name="dospen2"]').val(dosen2).change();
            // $('#editCategoryModal form input[name="max_score"]').val(maxScore);
          })

          // $('.edit').on('click', function(e) {
          //   e.preventDefault();
          // var id = $(this).data('id');
          // var dosen1 = $(this).data('dosen1');
          // var dosen2 = $(this).data('dosen2');
          //   console.log(dosen1);
          // // console.log(d);
          // // var name = $(this).data('name');
          // // var parentId = $(this).data('parent-id');
          // // var maxScore = $(this).data('max-score');
          // var url = "{{ url('sidang/jadwal') }}/" + id;

          // $('#myModal form').attr('action', url);
          // $('#myModal form select[name="dospen1"]').val(dosen1).change();
          // $('#myModal form select[name="dospen2"]').val(dosen2).change();
          // // $('#editCategoryModal form input[name="max_score"]').val(maxScore);
          // });
        });
        </script>
@endsection