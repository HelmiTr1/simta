@extends('layouts.app')

@section('title')
    Generate Jadwal Sidang
@endsection
@section('bread')
{{ Breadcrumbs::render('jadwal') }}
@endsection
@section('content')
<div class="row">
    <div class="col-xl-8">
      <div class="card">
        <div class="card-header border-0 mb-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Generate Jadwal Sidang</h3>
            </div>
          </div>

        </div>
        <hr class="my-0">
        <div class="card-body mt-0">
        <form method="POST" action="{{url('sidang/jadwal')}}">
            @csrf
                <div class="form-group row">
                  <label for="inputbatch3" class=" col-sm-2 col-form-label col-form-label-sm">Batch</label>
                  <div class="col-sm-10">
                    <select name="batch" id="batch" class="form-control form-control-sm @error('batch') is-invalid @enderror">
                      <option value="">--Select Batch--</option>
                      <option value="1" {{old('batch') == '1' ? 'selected':''}}>1</option>
                      <option value="2" {{old('batch') == '2' ? 'selected':''}}>2</option>
                      <option value="3" {{old('batch') == '3' ? 'selected':''}}>3</option>
                      <option value="No Batch" {{old('batch') == 'No Batch' ? 'selected':''}}>No Batch</option>
                    </select>
                    @error('batch')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>
                <div class="form-group row mb-0">
                  <label for="inputPopulasi3" class=" col-sm-2 col-form-label col-form-label-sm">Range Pendaftaran</label>
                  <div class="col-sm-10">
                    <div class="input-daterange datepicker row align-items-center">
                      <div class="col">
                          <div class="form-group">
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                  </div>
                                  <input class="form-control" placeholder="Start date" name="start" id="start" type="text" value="{{ old('start') !==null? old('start') : date('Y-m-d',strtotime('-5 days', strtotime(date('Y-m-d'))))}}">
                              </div>
                          </div>
                      </div>
                      <div class="col">
                          <div class="form-group">
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                  </div>
                                  <input class="form-control" placeholder="End date" name="end" id="end" type="text" value="{{ old('end') !==null? old('end') : date('Y-m-d')}}">
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
                </div>
                <div class="form-group row">
                  <label for="inputPopulasi3" class=" col-sm-2 col-form-label col-form-label-sm">Mulai Sidang</label>
                  <div class="col-sm-10">
                    <div class="input-group">
                      <div class="input-group-prepend">
                          <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                      </div>
                      <input class="form-control datepicker @error('mulai') is-invalid @enderror"  name="mulai" placeholder="Select date" type="text" value="{{ old('mulai') !==null? old('mulai') : date('Y-m-d')}}">
                      @error('mulai')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                </div>
                </div>
                <div class="form-group row">
                  <label for="inputPopulasi3" class=" col-sm-2 col-form-label col-form-label-sm"></label>
                  <div class="col-sm-10">
                    <a href="" class="btn btn-warning btn-sm" id="opsibtn">Opsi Lain <i class="ni ni-bold-down"></i></a>
                    <a href="" class="btn btn-warning btn-sm d-none" id="opsibtn2">Opsi Lain <i class="ni ni-bold-up"></i></a>
                </div>
                </div>
                <div id="opsi" class="d-none">
                <div class="form-group row">
                  <label for="inputPopulasi3" class=" col-sm-2 col-form-label col-form-label-sm">Populasi</label>
                  <div class="col-sm-10">
                  <input type="text" name="populasi" id="populasi" class="form-control form-control-sm" value="{{old('populasi')!==null ? old('populasi'):'10'}}">
                    @error('populasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>
                <div class="form-group row">
                  <label for="inputcrossover3" class=" col-sm-2 col-form-label col-form-label-sm">CrossOver Rate</label>
                  <div class="col-sm-10">
                  <input type="text" name="crossover" id="crossover" class="form-control form-control-sm" value="{{old('crossover')!==null ? old('crossover'):'0.70'}}">
                    @error('crossover')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>
                <div class="form-group row">
                  <label for="inputmutasi3" class=" col-sm-2 col-form-label col-form-label-sm">Mutasi Rate</label>
                  <div class="col-sm-10">
                  <input type="text" name="mutasi" id="mutasi" class="form-control form-control-sm" value="{{old('mutasi')!==null ? old('mutasi'):'0.40'}}">
                    @error('mutasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>
                <div class="form-group row">
                  <label for="inputgenerasi3" class=" col-sm-2 col-form-label col-form-label-sm">Generasi</label>
                  <div class="col-sm-10">
                  <input type="text" name="generasi" id="generasi" class="form-control form-control-sm" value="{{old('generasi')!==null ? old('generasi'):'100'}}">
                    @error('generasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                </div>
              </div>
                <div class="form-group row text-right">
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Generate</button>
                  <a href="{{url('sidang')}}" class="btn btn-danger" id="btn-cancel">Cancel</a>
                  </div>
                </div>
              </form>
        </div>
        </div>
      </div>
    </div>

@endsection

@section('footer')
  <script src="{{url('assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>

  <script>
    $(document).ready(function() {
      $('.datepicker').datepicker({
        format : 'yyyy-mm-dd',
      });
      $('#opsibtn').click(function(e){
        e.preventDefault();
        $('#opsi').removeClass('d-none');
        $('#opsibtn').addClass('d-none');
        $('#opsibtn2').removeClass('d-none');
      });
      $('#opsibtn2').click(function(e){
        e.preventDefault();
        $('#opsi').addClass('d-none');
        $('#opsibtn2').addClass('d-none');
        $('#opsibtn').removeClass('d-none');
      });
    });
    </script>
@endsection