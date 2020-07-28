@extends('layouts.app')

@section('title')
    Edit User
@endsection

@section('content')
<div class="row">
    <div class="col-xl-8">
      <div class="card">
        <div class="card-header border-0 mb-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Edit Data User</h3>
            </div>
          </div>
        </div>
        <hr class="my-0">
        <div class="card-body mt-0">
        <form method="POST" action="{{url('user').'/'.$user->id}}" >
          @method('patch')
            @csrf
                <div class="form-group row">
                  <label for="inputUsername3" class="col-sm-2 col-form-label">Username</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="inputUsername3" placeholder="Username" value="{{$user->username}}">
                    @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>
                <div class="form-group row">
                  <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="inputPassword3" placeholder="Password" value="{{$user->password}}" disabled>
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror  
                </div>
                </div>
                
                <div class="form-group row mb-0">
                  <label for="inputPassword4" class="col-sm-2 col-form-label">Confirm Password</label>
                  <div class="col-sm-10">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="inputPassword4" placeholder="Confirm Password" value="{{$user->password}}" disabled>
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>
                <div id="resetbtn" class="form-group row">
                  <div class="col-sm-12 text-right">
                    <a id="reset" href="" class="badge badge-warning">Reset Password</a>
                    <a id="cancel" href="" class="badge badge-danger d-none">Cancel</a>
                    <input type="hidden" name="valid" id="valid" value="0">
                  </div>
                </div>
                <div class="form-group row">
                    <label for="inputLevel3" class="col-sm-2 col-form-label">Level</label>
                    <div class="col-sm-10">
                      <select class="form-control @error('level') is-invalid @enderror" name="level" id="inputLevel3">
                        <option value="">--Pilih Level--</option>
                        @foreach ($level as $l)
                        @if ($user->level_id === $l->id)
                        <option value="{{$l->id}}" selected>{{$l->level}}</option>
                      @else
                        <option value="{{$l->id}}">{{$l->level}}</option>
                      @endif
                          @endforeach
                      </select>
                      @error('level')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror  
                  </div>
                  </div>
                <div class="form-group row text-right">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                  <a href="{{url('user')}}" class="btn btn-danger" onclick="return confirm('Are you sure?')">Cancel</a>
                  </div>
                </div>
              </form>
        </div>
        </div>
      </div>
    </div>

@endsection
@section('footer')
<script>
  $(document).ready(function() {
    $('#reset').click(function(e) {
      e.preventDefault();
      $('#inputPassword3').attr('disabled',false);
      $('#inputPassword4').attr('disabled',false);
      $('#reset').addClass('d-none');
      $('#cancel').removeClass('d-none');
      $('#valid').val(1);
    })
    $('#cancel').click(function(e) {
      e.preventDefault();
      $('#inputPassword3').attr('disabled',true);
      $('#inputPassword4').attr('disabled',true);
      $('#cancel').addClass('d-none');
      $('#reset').removeClass('d-none');
      $('#valid').val(0);

    })
  })
</script>
@endsection