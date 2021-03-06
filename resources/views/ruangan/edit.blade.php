@extends('layouts.app')

@section('title')
    Edit Ruangan
@endsection
@section('content')
<div class="row">
    <div class="col-xl-8">
      <div class="card">
        <div class="card-header border-0 mb-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Edit Data Ruangan</h3>
            </div>
          </div>
        </div>
        <hr class="my-0">
        <div class="card-body mt-0">
        <form method="POST" action="{{url('sidang/ruangan').'/'.$ruangan->id}}">
          @method('patch')
            @csrf
                <div class="form-group row">
                  <label for="inputeuangan3" class="col-sm-3 col-form-label">Kode Ruangan</label>
                  <div class="col-sm-9">
                  <input type="text" class="form-control @error('kode_ruangan') is-invalid @enderror" name="kode_ruangan" id="inputRuangan3" placeholder="Kode Ruangan" value="{{$ruangan->kode_ruangan}}">
                    @error('kode_ruangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>
                <div class="form-group row">
                  <label for="inputeuangan3" class="col-sm-3 col-form-label">Ruangan</label>
                  <div class="col-sm-9">
                  <input type="text" class="form-control @error('ruangan') is-invalid @enderror" name="ruangan" id="inputRuangan3" placeholder="Ruangan" value="{{$ruangan->nama_ruangan}}">
                    @error('ruangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>
                <div class="form-group row text-right">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Save</button>
                  <a href="{{url('sidang/ruangan')}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Cancel</a>
                  </div>
                </div>
              </form>
        </div>
        </div>
      </div>
    </div>

@endsection