@extends('layouts.app')

@section('title')
    Add Content
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8">
      <div class="card">
        <div class="card-header border-0 mb-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Tambah Data Content</h3>
            </div>
          </div>
        </div>
        <hr class="my-0">
        <div class="card-body mt-0">
        <form method="POST" action="{{url('content')}}">
            @csrf
                <div class="form-group row">
                  <label for="inputcontent3" class="col-sm-2 col-form-label">Judul</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control @error('content') is-invalid @enderror" name="content" id="inputcontent3" placeholder="Judul" value="{{old('content')}}">
                    @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>
                <div class="form-group row">
                  <label for="inputisi3" class="col-sm-2 col-form-label">Isi</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('isi') is-invalid @enderror" name="isi" id="inputisi3" placeholder="Isi" value="{{old('isi')}}">
                      
                    @error('isi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror  
                </div>
                </div>
                <div class="form-group row">
                  <label for="inputurl3" class="col-sm-2 col-form-label">URL</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" id="inputurl3" placeholder="URL" value="{{old('url')}}">
                    @error('url')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror  
                </div>
                </div>
                <div class="form-group row">
                  <label for="inputicon3" class="col-sm-2 col-form-label">Icon</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('icon') is-invalid @enderror" name="icon" id="inputicon3" placeholder="Icon" value="{{old('icon')}}">
                    @error('icon')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror  
                </div>
                </div>
                <div class="form-group row">
                  <label for="inputLevel3" class="col-sm-2 col-form-label">Level</label>
                  <div class="col-sm-10">
                    <select class="form-control @error('level') is-invalid @enderror" name="level" id="inputLevel3">
                      <option value="">--Pilih Level--</option>  
                      @foreach ($level as $l)
                    <option value="{{$l->id}}">{{$l->level}}</option>
                        @endforeach
                    </select>
                    @error('level')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror  
                </div>
                </div>
                <div class="form-group row">
                  <label for="inputMenu3" class="col-sm-2 col-form-label">Menu</label>
                  <div class="col-sm-10">
                    <select class="form-control @error('menu') is-invalid @enderror" name="menu" id="inputMenu3">
                      <option value="">--Pilih Menu--</option>  
                      @foreach ($menu as $m)
                    <option value="{{$m->id}}">{{$m->menu}}</option>
                        @endforeach
                    </select>
                    @error('level')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror  
                </div>
                </div>
                <div class="form-group row text-right">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Save</button>
                  <a href="{{url('content')}}" class="btn btn-danger" id="btn-cancel">Cancel</a>
                  </div>
                </div>
              </form>
        </div>
        </div>
      </div>
    </div>

@endsection