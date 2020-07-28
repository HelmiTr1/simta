@extends('layouts.app')

@section('title')
    Jadwal Sidang
@endsection
@section('bread')
{{ Breadcrumbs::render('jadwal') }}
@endsection
@section('content')
<div class="row">
    <div class="col-xl-9">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col">
            <h5 class="card-title text-uppercase text-muted mb-0">{{ucfirst($s)}}</h5>
            <span class="h2 font-weight-bold mb-0">Jadwal Sidang </span>
            </div>
            <div class="col-auto"> 
              <a data-toggle="collapse" href="#jadwalExample" role="button" aria-expanded="false" aria-controls="collapseExample">
              <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
              <i class="ni ni-paper-diploma"></i>
              </div>
              </a>
            </div>
          </div>
          <p class="mt-3 mb-0">
            @if(Auth::user()->level_id == '2')
            <small>
              Jadwal untuk {{ucfirst($s)}} 
              <b class="font-weight-bold">{{$dosen->nama}}</b>
            </small>
            <div class="col-xl-12 mt-3">
                  <div class="table-responsive">
            
                    <!-- Projects table -->
                    <table id="ruangan1" class="table align-items-center table-flush">
                      <thead class="thead-light">
                        <tr>
                          <th scope="col">Tanggal</th>
                          <th scope="col">Jam</th>
                          <th scope="col">Ruangan</th>
                          <th scope="col">Mahasiswa</th>
                        </tr>
                      </thead>
                      <tbody>
                      @foreach($jadwal2 as $data)
                      <tr>
                        <?php
                        Date::setLocale('id');
                        $date = new Date($data->tanggal);
                        ?>
                      <th scope="col">{{$date->format('l, j F Y')}}</th>
                      <th scope="col">{{$data->waktu}}</th>
                      <th scope="col">{{$data->ruangan}}</th>
                      <th scope="col">{{$data->mhs}}</th>
                      </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
            </div>
            @endif
            @if(Auth::user()->level_id == '3')
            <small>
              <span class="text-wrap">Jadwal sidang yang dihadiri oleh {{ucfirst($s)}}
                @foreach($jadwal as $data)
                @if($data->nim == Auth::user()->username)
                 dengan nama <b class="font-weight-bold">{{$data->mhs}}</b> <br/>
                 
                 <table>
                   <tr>
                     <td><small>Pada Tanggal</small> </td>
                     <td><small>:</small> </td>
                   <?php
                   Date::setLocale('id');
                   $date = new Date($data->tanggal);
                   ?>
                     <td><small><b class="font-weight-bold">{{$date->format('l, j F Y')}}</b></small></td>
                   </tr>
                   <tr>
                     <td><small>Jam Sidang</small>  </td>
                     <td><small>:</small> </td>
                     <td><small><b class="font-weight-bold">{{$data->waktu}}</b> WITA</small></td>
                   </tr>
                   <tr>
                     <td><small>Ruangan</small>  </td>
                     <td><small>:</small> </td>
                     <td><small><b class="font-weight-bold">{{$data->kode_ruangan.' - '.$data->ruangan}}</b></small></td>
                   </tr>

                 </table>
                @endif
                @endforeach
              </span>
            </small>
            @endif
            <div class="collapse" id="jadwalExample">
              
              <div id="calendar"></div>
            </div>
            </p>
        </div>
    </div>
</div>
</div>
@endsection
@section('link')
<link href='{{url('assets/fullcalendar/core/main.css')}}' rel='stylesheet' />
    <link href='{{url('assets/fullcalendar/daygrid/main.css')}}' rel='stylesheet' />

    <script src='{{url('assets/fullcalendar/core/main.js')}}'></script>
    <script src='{{url('assets/fullcalendar/daygrid/main.js')}}'></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
          plugins: [ 'dayGrid','bootstrap' ],
          eventLimit: true, 
          views: {
            timeGrid: {
              eventLimit: 3
            }
          },
          header:{
            left:'',
            center:'',
            right:''
          },
          events: [
            @foreach($jadwal as $data)
            { 
              title: '{{$data->mhs}}', 
              start: '{{$data->tanggal}}', 
              end: '{{$data->tanggal}}' ,
              id : '{{$data->id}}',
              @if(Auth::user()->level_id == '3')
              @if($data->nim == Auth::user()->username)
              backgroundColor: '#fb6340',
              borderColor: '#fb6340',
              @else
              backgroundColor: '#11cdef',
              borderColor: '#11cdef',
              @endif
              @endif
            },
            @endforeach
          ],
        });

        calendar.setOption('locale', 'id');

        calendar.render();
      });
    </script>
@endsection