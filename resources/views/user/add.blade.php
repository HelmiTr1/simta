@extends('layouts.app')

@section('title')
    Add User
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8">
      <div class="card">
        <div class="card-header border-0 mb-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Tambah Data User</h3>
            </div>
          </div>
        </div>
        <hr class="my-0">
        <div class="card-body mt-0">
        <form method="POST" action="{{url('user')}}">
            @csrf
                <div class="form-group row">
                  <label for="inputUsername3" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="inputUsername3" placeholder="Username" value="{{old('username')}}">
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="inputPassword3" placeholder="Password">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror  
                </div>
                </div>
                
                <div class="form-group row">
                  <label for="inputPassword4" class="col-sm-2 col-form-label">Confirm Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="inputPassword4" placeholder="Confirm Password">
                    @error('password_confirmation')
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
                      <option value="{{$l->id}}" {{old('level')== $l->id ? 'selected' : ''}}>{{$l->level}}</option>
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
                  <a href="{{url('user')}}" class="btn btn-danger" id="btn-cancel">Cancel</a>
                  </div>
                </div>
              </form>
        </div>
        </div>
      </div>
    </div>

@endsection