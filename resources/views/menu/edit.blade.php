@extends('layouts.app')

@section('title')
    Edit Menu
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8">
      <div class="card">
        <div class="card-header border-0 mb-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Edit Data Menu</h3>
            </div>
          </div>
        </div>
        <hr class="my-0">
        <div class="card-body mt-0">
        <form method="POST" action="{{url('menu').'/'.$menu->id}}" >
          @method('patch')
            @csrf
                <div class="form-group row">
                  <label for="inputmenu3" class="col-sm-2 col-form-label">Menu</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control @error('menu') is-invalid @enderror" name="menu" id="inputmenu3" placeholder="Menu" value="{{$menu->menu}}">
                    @error('menu')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>
                <div class="form-group row">
                  <label for="inputurl3" class="col-sm-2 col-form-label">URL</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" id="inputurl3" placeholder="URL" value="{{$menu->url}}">
                    @error('url')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror  
                </div>
                </div>
                <div class="form-group row">
                  <label for="inputicon3" class="col-sm-2 col-form-label">Icon</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control @error('icon') is-invalid @enderror" name="icon" id="inputicon3" placeholder="Icon" value="{{$menu->icon}}">
                    @error('icon')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror  
                </div>
                </div>
                
                <div class="form-group row text-right">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Save</button>
                  <a href="{{url('menu')}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Cancel</a>
                  </div>
                </div>
              </form>
        </div>
        </div>
      </div>
    </div>

@endsection