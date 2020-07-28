@extends('layouts.app')

@section('title')
    Nilai Sidang
@endsection
@section('bread')
{{ Breadcrumbs::render('isi',$nilai) }}
@endsection

@section('content')
<div class="row">
    <div class="col-xl-7">
      <div class="card">
        <div class="card-header border-0 mb-0">
          <div class="row align-items-center">
            <div class="col">
            <h3 class="mb-0">Nilai <b class="font-weight-bold">{{$mhs->nama}}</b></h3>
            </div>
          </div>
        </div>
        <hr class="my-0">
        <div class="card-body mt-0">
        <form method="POST" action="{{url('sidang/nilai').'?idc='.$nilai}}" >
          @method('post')
            @csrf
        <input type="hidden" name="id" value="{{count($aspekNilai)}}">
        @php
            $i=1;
        @endphp
            @foreach ($aspekNilai as $data)
                <div class="form-group row">

                <label for="input{{$data->id}}3" class="col-sm-4 col-form-label col-form-label-sm">{{$data->aspeknilai}}</label>
                <div class="col-sm-8">
                <input type="hidden" name="ian[{{$i}}]" value="{{$data->id}}">
                    <input type="number" step="0.01" name="nilai[{{$i}}]" id="nilai[{{$i}}]" class="form-control form-control-sm @error('nilai[$i]') is-invalid @enderror" value="{{old('nilai[$i]') ? old('nilai[$i]') : __('0')}}">
                    @error('nilai[$i]')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
            </div>
            @php
                $i++;
            @endphp
            @endforeach
                
                <div class="form-group row text-right">
                  <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                  <a href="{{url('sidang/nilai')}}" class="btn btn-danger" id="btn-cancel">Cancel</a>
                  </div>
                </div>
              </form>
        </div>
        </div>
      </div>
    </div>
@endsection