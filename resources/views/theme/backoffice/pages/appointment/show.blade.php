@extends('theme.backoffice.layouts.admin')

@section('title', 'Citas programadas')

@section('head')
    <link href='{{ asset('assets/plugins/lib/main.css') }}' rel='stylesheet' />
@endsection

@section('breadcrumbs')
    <li><a href="">Citas programadas</a></li>
@endsection

@section('dropdown_settings')
@endsection

@section('content')
<div class="section">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <div id='loading'>loading...</div>
                    <div id="calendar"></div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('foot')
    <script src='{{ asset('assets/plugins/lib/main.min.js') }}'></script>

    <script>

        document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');
      
          var calendar = new FullCalendar.Calendar(calendarEl, {
      
            headerToolbar: {
              left: 'prev,next today',
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay,listYear'
            },
      
            displayEventTime: true, // don't show the time column in list view
      
            // THIS KEY WON'T WORK IN PRODUCTION!!!
            // To make your own Google API key, follow the directions here:
            // http://fullcalendar.io/docs/google_calendar/
            googleCalendarApiKey: 'AIzaSyDcnW6WejpTOCffshGDDb4neIrXVUA1EAE',
      
            // US Holidays
            events: {!! $appointments !!},
      
            loading: function(bool) {
              document.getElementById('loading').style.display =
                bool ? 'block' : 'none';
            }
      
          });
      
          calendar.render();
        });
      
      </script>
    
@endsection