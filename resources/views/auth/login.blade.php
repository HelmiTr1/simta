@extends('layouts.login')

@section('content')
<div class="container mt--8 pb-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card bg-secondary">
                
                <div class="card-header bg-transparent text-center  border-0"> <small>Silakan login menggunakan <i>username</i> dan <i> password</i>.</small></div>
                <div class="card-body ">
                    <div class="text-center text-muted ">
                        @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-text"><strong>Success!</strong> {{session('status')}}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if (session('error'))
                        <div class="alert alert-danger alert-sm">
                            {{session('error')}}
                        </div>
                        @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <div class="input-group input-group-merge input-group-alternative">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="ni ni-circle-08"></i></span>
                                </div>
                            <input class="form-control @error('username') is-invalid @enderror" id="username" name="username" placeholder="Username" type="text" value="{{old('username')}}" autofocus>
                                @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                            <div class="form-group">
                                <div class="input-group input-group-merge input-group-alternative">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                  </div>
                                  <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">
                                  @error('password')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                </div>
                              </div>

                        <div class="text-center">
                                <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
