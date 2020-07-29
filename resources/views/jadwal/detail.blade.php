@extends('layouts.app')

@section('title')
    Jadwal Sidang
@endsection
@section('bread')
{{ Breadcrumbs::render('jadwal') }}
@endsection
@section('content')
@if (count($jadwal)>0)

<div class="row">
    <div class="col-xl-12">
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
            <div class="collapse" id="jadwalExample">
              <div class="text-center mb-3">
                <a href="#" class="btn btn-sm btn-primary" data-calendar-view="month">Month</a>
                <a href="#" class="btn btn-sm btn-primary" data-calendar-view="basicWeek">Week</a>
                <a href="#" class="btn btn-sm btn-primary" data-calendar-view="basicDay">Day</a>
              </div>
              <div class="calendar" data-toggle="calendar" id="calendar"></div>
            </div>
            @endif
            @if(Auth::user()->level_id == '3')
            <div class="collapse" id="jadwalExample">
              <div class="text-center mb-3">
                <a href="#" class="btn btn-sm btn-primary" data-calendar-view="month">Month</a>
                <a href="#" class="btn btn-sm btn-primary" data-calendar-view="basicWeek">Week</a>
                <a href="#" class="btn btn-sm btn-primary" data-calendar-view="basicDay">Day</a>
              </div>
              <div class="calendar" data-toggle="calendar" id="calendar"></div>
            </div>
            <div class="mt-4">
              <small >
                  <span class="text-wrap text-sm">Jadwal sidang yang dihadiri oleh {{ucfirst($s)}}
                    @foreach($jadwal as $data)
                    @if($data->nim == Auth::user()->username)
                    @php
                      Date::setLocale('id');
                      $date = new Date($data->tanggal);
                    @endphp
                     dengan nama <b class="font-weight-bold">{{$data->mhs}}</b> adalah tanggal : <b class="font-weight-bold">{{$date->format('l, j F Y')}}</b>
                  <a href="" class="btn btn-primary btn-sm" id="detail" data-toggle="modal" data-target="#myModal" data-id="{{$data->id}}"  data-nama="{{$data->mhs}}" data-tanggal="{{$date->format('l, j F Y')}}" data-waktu="{{$data->waktu}}" data-ruangan="{{$data->kode_ruangan.' - '.$data->ruangan}}" data-dosen1="{{$data->dospem1}}" data-dosen2="{{$data->dospem2}}" data-dosen3="{{$data->dospen1}}" data-dosen4="{{$data->dospen2}}"> Lihat Detail</a> </span>
                     @endif
                     @endforeach
              </small>
            </div>
            @endif
            </p>
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mb-0">
        <h3 class="h3">Detail Jadwal Sidang</h3>
      </div>
      <div class="modal-body mt-0">
         <div class="row text-sm">
           <div class="col-5">Nama Mahasiswa</div>
           <div class="col-7">: <span id="name1"></span></div>
         </div>
         <div class="row text-sm">
           <div class="col-5">Hari/Tanggal</div>
           <div class="col-7">: <span id="date1"></span></div>
         </div>
         <div class="row text-sm">
           <div class="col-5">Jam Sidang</div>
           <div class="col-7">: <span id="waktu1"></span></div>
         </div>
         <div class="row text-sm">
           <div class="col-5">Ruangan</div>
           <div class="col-7">: <span id="ruangan1"></span></div>
         </div>
         <br/>
           <hr class="divider">
         <div class="row text-sm">
           <div class="col-5">Dosen Pembimbing 1</div>
           <div class="col-7">: <span id="dosen11"></span></div>
         </div>
         <div class="row text-sm">
           <div class="col-5">Dosen Pembimbing 2</div>
           <div class="col-7">: <span id="dosen21"></span></div>
         </div>
         <br/>
           <hr class="divider mt-0">
         <div class="row text-sm">
           <div class="col-5">Dosen Penguji 1</div>
           <div class="col-7">: <span id="dosen31"></span></div>
         </div>
         <div class="row text-sm">
           <div class="col-5">Dosen Penguji 2</div>
           <div class="col-7">: <span id="dosen41"></span></div>
         </div>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
         <button class="btn btn-primary ml-auto" data-dismiss="modal">Close</button>
      </div>
   </div>
  </div>
</div>
<div class="modal fade" id="edit-event" tabindex="-1" role="dialog" aria-labelledby="edit-event-label" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
     <div class="modal-content">
        <div class="modal-header mb-0">
          <h3 class="h3">Detail Jadwal Sidang</h3>
        </div>
        <div class="modal-body mt-0">
           <div class="row text-sm">
             <div class="col-5">Nama Mahasiswa</div>
             <div class="col-7">: <span id="name"></span></div>
           </div>
           <div class="row text-sm">
             <div class="col-5">Hari/Tanggal</div>
             <div class="col-7">: <span id="date"></span></div>
           </div>
           <div class="row text-sm">
             <div class="col-5">Jam Sidang</div>
             <div class="col-7">: <span id="waktu"></span></div>
           </div>
           <div class="row text-sm">
             <div class="col-5">Ruangan</div>
             <div class="col-7">: <span id="ruangan"></span></div>
           </div>
           <br/>
           <hr class="divider">
           <div class="row text-sm">
             <div class="col-5">Dosen Pembimbing 1</div>
             <div class="col-7">: <span id="dosen1"></span></div>
           </div>
           <div class="row text-sm">
             <div class="col-5">Dosen Pembimbing 2</div>
             <div class="col-7">: <span id="dosen2"></span></div>
           </div>
           <br/>
           <hr class="divider mt-0">
           <div class="row text-sm">
             <div class="col-5">Dosen Penguji 1</div>
             <div class="col-7">: <span id="dosen3"></span></div>
           </div>
           <div class="row text-sm">
             <div class="col-5">Dosen Penguji 2</div>
             <div class="col-7">: <span id="dosen4"></span></div>
           </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
           <button class="btn btn-primary ml-auto" data-dismiss="modal">Close</button>
        </div>
     </div>
  </div>
</div>
@else
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body text-center">
      Jadwal belum di<i>generate</i>. Silahkan hubungi admin.
      </div>
    </div>
  </div>
</div>
@endif
@endsection
@section('link')
<link rel="stylesheet" href="{{url('assets/vendor/fullcalendar/dist/fullcalendar.min.css')}}">

@endsection

@section('footer')
<script>
  $(document).ready(function(){
    $(document).on("click","#detail",function(e) {
      e.preventDefault();
      var id = $(this).data('id');
      var nama = $(this).data('nama');
      var tanggal = $(this).data('tanggal');
      var ruangan = $(this).data('ruangan');
      var waktu = $(this).data('waktu');
      var dosen1 = $(this).data('dosen1');
      var dosen2 = $(this).data('dosen2');
      var dosen3 = $(this).data('dosen3');
      var dosen4 = $(this).data('dosen4');

      $('#name1').html('<span class="font-weight-bold"> '+nama+'</span>');
      $('#date1').html('<span class="font-weight-bold"> '+tanggal+'</span>');
      $('#ruangan1').html('<span class="font-weight-bold"> '+ruangan+'</span>');
      $('#waktu1').html('<span class="font-weight-bold"> '+waktu+' WITA</span>');
      $('#dosen11').html('<span class="font-weight-bold"> '+dosen1+'</span>');
      $('#dosen21').html('<span class="font-weight-bold"> '+dosen2+'</span>');
      $('#dosen31').html('<span class="font-weight-bold"> '+dosen3+'</span>');
      $('#dosen41').html('<span class="font-weight-bold"> '+dosen4+'</span>');

    })
  });
</script>
    <script src="{{url('assets/vendor/moment/min/moment.min.js')}}"></script>
    <script src="{{url('assets/vendor/fullcalendar/dist/fullcalendar.min.js')}}"></script>
    <script>
      //
      // Fullcalendar
      //

      'use strict';

      var Fullcalendar = (function() {

        // Variables

        var $calendar = $('[data-toggle="calendar"]');

        //
        // Methods
        //

        // Init
        function init($this) {

          // Calendar events

          var events = [
              @foreach($jadwal as $data)
              { 
                title: '{{$data->mhs}}', 
                start: '{{$data->tanggal}}',
                end: '{{$data->tanggal}}' ,
                @php
                  Date::setLocale('id');
                  $date = new Date($data->tanggal);
                @endphp
                tanggal : "{{$date->format('l, j F Y')}}",
                waktu : "{{$data->waktu}}",
                ruangan : "{{$data->kode_ruangan.' - '.$data->ruangan}}",
                id : '{{$data->id}}',
                dosen1 : '{{$data->dospem1}}',
                dosen2 : '{{$data->dospem2}}',
                dosen3 : '{{$data->dospen1}}',
                dosen4 : '{{$data->dospen2}}',
                @if($data->nim == Auth::user()->username || $data->dosen1== Auth::user()->username || $data->dosen2== Auth::user()->username || $data->dosenp1== Auth::user()->username || $data->dosenp1== Auth::user()->username)
                backgroundColor: '#fb6340',
                borderColor: '#fb6340',
                @endif
              },
              @endforeach
            ],

          options = {
            header: {
              right: '',
              center: '',
              left: ''
            },defaultView: 'week',
              views: {
                  week: {
                      type: 'basic', /* 'basicWeek' ?? */
                      duration: { week: 4 }
                  }
              },
              dayNames :['Minggu', 'Senin', 'Selasa', 'Rabu',
              'Kamis', 'Jum`at', 'Sabtu'],
              dayNamesShort :['Min', 'Sen', 'Sel', 'Rab',
              'Kam', 'Jum', 'Sab'],
              timeZone:'id',
              height: 100,
            buttonIcons: {
              prev: 'calendar--prev',
              next: 'calendar--next'
            },
            theme: false,
            selectable: true,
            selectHelper: true,
            events: events,

            viewRender: function(view) {
              var calendarDate = $this.fullCalendar('getDate');
              var calendarMonth = calendarDate.month();

              //Set title in page header
              $('.fullcalendar-title').html(view.title);
            },

            // Edit calendar event action

            eventClick: function(event, element) {
              // $('#edit-event input[value=' + event.className + ']').prop('checked', true);
              $('#edit-event').modal('show');
              $('#name').html('<span class="font-weight-bold"> '+event.title+'</span>');
              $('#date').html('<span class="font-weight-bold"> '+event.tanggal+'</span>');
              $('#ruangan').html('<span class="font-weight-bold"> '+event.ruangan+'</span>');
              $('#waktu').html('<span class="font-weight-bold"> '+event.waktu+' WITA</span>');
              $('#dosen1').html('<span class="font-weight-bold"> '+event.dosen1+'</span>');
              $('#dosen2').html('<span class="font-weight-bold"> '+event.dosen2+'</span>');
              $('#dosen3').html('<span class="font-weight-bold"> '+event.dosen3+'</span>');
              $('#dosen4').html('<span class="font-weight-bold"> '+event.dosen4+'</span>');
            }
          };

          // Initalize the calendar plugin
          $this.fullCalendar(options,{
            'locale' : 'id'
          });


          //
          // Calendar actions
          
          

          //Update/Delete an Event
          $('body').on('click', '[data-calendar]', function() {
            var calendarAction = $(this).data('calendar');
            var currentId = $('.edit-event--id').val();
            var currentTitle = $('.edit-event--title').val();
            var currentDesc = $('.edit-event--description').val();
            var currentClass = $('#edit-event .event-tag input:checked').val();
            var currentEvent = $this.fullCalendar('clientEvents', currentId);

            //Update
            if (calendarAction === 'update') {
              if (currentTitle != '') {
                currentEvent[0].title = currentTitle;
                currentEvent[0].description = currentDesc;
                currentEvent[0].className = [currentClass];

                console.log(currentClass);
                $this.fullCalendar('updateEvent', currentEvent[0]);
                $('#edit-event').modal('hide');
              } else {
                $('.edit-event--title').closest('.form-group').addClass('has-error');
                $('.edit-event--title').focus();
              }
            }

            
          });


          //Calendar views switch
          $('body').on('click', '[data-calendar-view]', function(e) {
            e.preventDefault();

            $('[data-calendar-view]').removeClass('active');
            $(this).addClass('active');

            var calendarView = $(this).attr('data-calendar-view');
            $this.fullCalendar('changeView', calendarView);
          });


          //Calendar Next
          $('body').on('click', '.fullcalendar-btn-next', function(e) {
            e.preventDefault();
            $this.fullCalendar('next');
          });


          //Calendar Prev
          $('body').on('click', '.fullcalendar-btn-prev', function(e) {
            e.preventDefault();
            $this.fullCalendar('prev');
          });
        }


        //
        // Events
        //

        // Init
        if ($calendar.length) {
          init($calendar);
        }

      })();

    </script>
    {{-- <script src="{{url('assets/js/components/vendor/fullcalendar.js')}}"></script> --}}
@endsection