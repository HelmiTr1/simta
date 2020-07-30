@extends('layouts.app')

@section('title')
    Berkas Revisi
@endsection
@section('bread')
{{ Breadcrumbs::render('berkas') }}
@endsection

@if (Auth::user()->level_id =='1')
@section('content')
<div class="row">
@foreach ($content as $c)
<div class="col-xl-4 col-md-6">
  <a href="{{url('/').'/'.$c->url}}" class="d-0">
    <div class="card card-stats">
      <!-- Card body -->
      <div class="card-body">
        <div class="row">
          <div class="col">
          <h5 class="card-title text-uppercase text-muted mb-0">{{$c->level->level}}</h5>
          <span class="h3 font-weight-bold mb-0">{{$c->judul}}</span>
          </div>
          <div class="col-auto">
            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
            <i class="{{$c->icon}}"></i>
            </div>
          </div>
        </div>
        <p class="mt-3 mb-0">
        <small class="text-wrap text-muted">{{$c->isi}}</small>
        </p>
      </div>
    </div>
  </a>
  </div>
@endforeach
</div>
@endsection
@elseif( Auth::user()->level_id =='3')
@if (count($jadwal)>0)
    @section('card')
    @if (count($revisi)==0)
    @php
      foreach ($jadwal as $data ) {
        $date = $data->tanggal;
      }
      Date::setLocale('id');
      $stamp = strtotime('+7 days', strtotime($date));
      $batas = new Date($stamp);
      $now = date('Y-m-d');
    @endphp
      <div class="col-xl-12">
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="alert-icon"><i class="ni ni-lock-circle-open"></i></span>
      <span class="alert-text"><strong>Perhatian!</strong> Batas akhir pengiriman berkas hasil revisi adalah  <span class="font-weight-bold">{{$batas->format('l, j F Y')}}</span> </span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
      </div>
    @endif
    @endsection
@section('content')
@foreach ($content as $c)
  <div class="row">
    <div class="col-xl-12">
          <div class="card card-stats">
            <!-- Card body -->
            <div class="card-body">
              <div class="row">
                <div class="col">
                <h5 class="card-title text-uppercase text-muted mb-0">{{$c->level->level}}</h5>
                <span class="h2 font-weight-bold mb-0">{{$c->judul}}</span>
                </div>
                <div class="col-auto">
                  <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                  <i class="{{$c->icon}}"></i>
                  </div>
                </div>
              </div>
              <p class="mt-3 mb-0 text-sm">
              <span class="text-wrap">{{$c->isi}}</span>
              @if (count($revisi)==0)
              @php
                  $batas = strtotime($batas);
                  $now = strtotime($now);
              @endphp
                @if ($batas < $now)
                <div class="row mt-4">
                  <div class="col-xl-12">
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span class="alert-icon"><i class="ni ni-fat-remove"></i></span>
                  <span class="alert-text"><strong>Perhatian!</strong> Pengiriman berkas revisi telah mencapai batas waktu, Silahkan Hubungi admin untuk perpanjangan Waktu </span>
                </div>
                  </div>
                </div>
                @else
                <div class="my-3">
                  <small>Berkas yg diupload berupa <span class="text-danger">*.pdf,</span>  dengan ukuran maksimal <span class="text-danger"> 500KB</span></small>
                      <input type="file" name="berkas" id="berkas">
                </div>
                @endif
              @else
              @foreach($revisi as $r)
              <div class="row">
  
              <div class=" col-xl-6 text-left">  <a href="{{url('berkas').'/'.$r->id}}"  target="_blank" >{{$r->filename}}</a></div>
              <div class=" col-xl-6 text-right"> 
                <a href="{{url('berkas').'/'.$r->id}}" class="btn btn-info btn-sm" target="_blank" ><i class="fas fa-fw fa-eye"></i><span>Lihat Berkas</span> </a>
                <form action="{{url('berkas').'/'.$r->id}}" method="post" class="d-inline" id="hapus-btn{{$r->id}}">
                    @method('delete')
                    @csrf
                  </form>
                  <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDelete({{$r->id}})"><i class="fas fa-fw fa-trash"></i><span>Upload Ulang</span> </button>
                    </div>
              </div>
              @endforeach
              @endif
              </p>
            </div>
          </div>
        </a>
      </div>
  </div>
  @endforeach
  @endsection
@else
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
@endif
@endif
  
@if( Auth::user()->level_id =='3')
  @section('link')
<link rel="stylesheet" href="{{url('assets/vendor/filepond/dist/filepond.min.css')}}">
@endsection
@section('footer')
<script src="{{url('assets/vendor/filepond/dist/filepond.min.js')}}"></script>
<script src="{{url('assets/vendor/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.min.js')}}"></script>
<script src="{{url('assets/vendor/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.min.js')}}"></script>
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
<script>
    $(document).ready(function() {
        
        FilePond.registerPlugin(
          FilePondPluginFileValidateSize,
          FilePondPluginFileValidateType,
        );

        FilePond.setOptions({
                    acceptedFileTypes: ['application/pdf'],
                    maxFileSize :'500KB',
                    server: {
                        url: '{{url("/")}}/filepond/api',
                        process: {
                            url: '/process',
                            onload: function (res) {
                                $('#berkas').data('res', res);
                                return res;
                            },
                            method:'POST',
                        },
                        revert: '/process',
                        headers: {
                          'X-CSRF-Token':'{{csrf_token()}}'
                        }
                    },
                    allowRevert: true,
                });
                
      const upfile = function(file) {
        $.ajax({
        url: "{{url('/berkas')}}",
        data: {
            filename: file.filename
        },
        headers: {'X-CSRF-Token':$('meta[name=csrf_token]').attr('content')},
        method: 'POST',
        dataType: 'json',
        success: function (res) {
          if (res.success =='done') {
              Swal.fire({
                  title: 'Berhasil!',
                  text: "Berkas lampiran revisi berhasil diupload!",
                  icon: 'success',
                  confirmButtonColor: '#3085d6',
                  confirmButtonText: 'Ok!'
                }).then((result) => {
                  if (result.value) {
                      location.reload(true);
                  }
                })
              }else{
                Swal.fire({
                  title: 'Gagal!',
                  text: "Berkas lampiran revisi gagal diupload!",
                  icon: 'error'
                  });
              }
        }
      })
      }
        const pond = FilePond.create(document.getElementById('berkas'));
        pond.on('processfile', (e, file) => {
          
          if (file) {
          upfile(file);
          }else{
            Swal.fire({
                  title: 'Gagal!',
                  text: "Berkas lampiran revisi gagal diupload!",
                  icon: 'error'
                  });
          }
                });
    })
</script>
@endsection
@endif