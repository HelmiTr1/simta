@extends('layouts.app')

@section('title')
    Berkas Revisi
@endsection
@section('bread')
{{ Breadcrumbs::render('berkas') }}
@endsection
@section('content')
@if (count($jadwal)>0)
@if (Auth::user()->level_id =='1')
    
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
@elseif( Auth::user()->level_id =='3')
@foreach ($content as $c)
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
<div class="row">
  <div class="col-xl-12">
  <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <span class="alert-icon"><i class="ni ni-lock-circle-open"></i></span>
  <span class="alert-text"><strong>Perhatian!</strong> Batas akhir pengiriman berkas hasil revisi adalah : <span class="font-weight-bold">{{$batas->format('l, j F Y')}}</span> </span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
  </div>
</div>
@endif
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
              @if (session('status'))
              <div class="alert alert-danger">
                  {{ session('status') }}
              </div>
              @endif
              @if (count($revisi)==0)
              @if ($batas==$now)
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
                      <div class="custom-file">
                          <input type="file" class="custom-file-input" id="revisi" name="revisi" lang="en" accept="application/pdf">
                          <label class="custom-file-label" for="customFileLang">Select file</label>
                          <div class="invalid-feedback mt-0" id="invalid"></div>
                          <div class="invalid-feedback mt-0" id="invalid2"></div>
                          <div id="uploading"></div>
                      </div>
                </div>
                @endif
              @else
              @foreach($revisi as $r)
              <div class="row">
  
              <div class=" col-xl-6 text-left">  <a href="{{url('berkas').'/'.$r->id}}"  target="_blank" >{{$r->filename}}</a></div>
              <div class=" col-xl-6 text-right"> <form action="{{url('berkas').'/'.$r->id}}" method="post" class="d-inline" id="hapus-btn{{$r->id}}">
                    @method('delete')
                    @csrf
                  </form>
                  <button type="submit" class="btn btn-sm btn-danger" onclick="confirmDelete({{$r->id}})">Delete</button>
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
@endif
@else
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body text-center">
      Jadwal belum di<i>generate</i>. Silahkan hubungi admin.
      </div>
    </div>
  </div>
</div>
@endif
@endsection
@if( Auth::user()->level_id =='3')
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
<script>
    $(document).ready(function() {
        $(document).on('change','#revisi',function() {
            var property = document.getElementById('revisi').files[0];
            var file_name = property.name;
            var file_typ = file_name.split('.').pop().toLowerCase();

            if (jQuery.inArray(file_typ,['pdf'])== -1) {
                $('#revisi').addClass('is-invalid');
                $('#invalid').html('File type not valid')
            }else{
            var file_size = property.size;
            if (file_size > 500000) {
                $('#revisi').addClass('is-invalid');
                $('#invalid2').html('File size is over limit')
            }else{
                var form = new FormData();
                form.append('revisi', property);
                var host = "{{url('/')}}";
                $.ajax({
                    url : host+'/berkas',
                    headers:{'X-CSRF-Token':$('meta[name=csrf_token]').attr('content')},
                    method: 'POST',
                    data : form,
                    contentType:false,
                    cache: false,
                    processData:false,
                    beforeSend:function(){
                        $('#uploading').html('<label class="text-warning text-sm"> Uploading file...</label>');
                    },
                    success:function(data) {
                        $('#uploading').html('<label class="text-success text-sm"> File uploaded</label>');
                        if (data.success =='done') {
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
                        }
                        
                    }
                })
                
            }

            }
            
        })
    })
</script>
@endsection
@endif