@extends('layouts.app')
@section('title')
    Sidang
@endsection
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
          <small class="text-wrap  text-muted">{{$c->isi}}</small>
          </p>
        </div>
      </div>
    </a>
    </div>
@endforeach
</div>
@endsection

@section('bread')
{{ Breadcrumbs::render('sidang') }}
@endsection