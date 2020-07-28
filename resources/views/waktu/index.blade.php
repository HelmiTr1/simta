@extends('layouts.app')
@section('title')
    Data Waktu
@endsection
@section('content')
<div class="row">
    <div class="col-xl-8">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Data Waktu</h3>
            </div>
          </div>
        </div>

        <div class="table-responsive">
            
          <!-- Projects table -->
          <table id="waktu1" class="table align-items-center table-flush table-hover">
            <thead class="thead-light">
              <tr>
                <th scope="col">Waktu</th>
                <th scope="col">Activated</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($waktu as $w)
                <tr>
                <td>
                    {{$w->waktu}}
                </td>
                <td>
                        @if($w->status===1)
                        <i class="ni ni-check-bold"></i>
                        @else
                        <i class="ni ni-fat-remove text-danger"></i>
                        @endif
                </td>
                <td>
                    @if($w->status===1)
                    <form action="{{url('sidang/waktu').'/'.$w->id}}" method="POST" class="d-inline">
                        @method('patch')
                        @csrf
                        <input type="hidden" name="status" value="0">
                        <button type="submit" class="btn btn-sm btn-danger">Non-Actived</button>
                          </form>
                    @else
                    <form action="{{url('sidang/waktu').'/'.$w->id}}" method="POST" class="d-inline">
                        @method('patch')
                        @csrf
                        <input type="hidden" name="status" value="1">
                        <button type="submit" class="btn btn-sm btn-success">Actived</button>
                          </form>
                    @endif
                </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
</div>

@endsection