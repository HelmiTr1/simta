@extends('layouts.app')
@section('title','Home')

@section('bread')
{{ Breadcrumbs::render('home') }}
@endsection

@section('content')
<div class="row">
    <div class="col-sm-4  col-md-6  col-lg-4  col-xl-4">
        <div class="card">
            <div class="card-body">
            <h3 class="font-weight-bold">Welcome to SiMTA</h3>
            <small>Sistem Informasi Manajemen Tugas Akhir pada Politeknik Negeri Tanah Laut</small>
            <div class="row mt-4">
            <div class="col-8">
                <img src="{{url('assets/img/brand/blue.png')}}" class="img-fluid" alt="SiMTA">
            </div>
            <div class="col-4">
                <div><a href="" ><small><i class="fas fa-fw fa-user-circle"></i><span>&nbsp;Profile</span> </small></a></div>
                <div><a class="text-danger" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <small><i class="fas fa-fw fa-power-off"></i><span>&nbsp;Logout</span> </small>
                </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="d-none">
                      @csrf
                  </form></div>
            </div>
            </div>
            </div>
        </div>
    </div>
    
    
</div>
@endsection
