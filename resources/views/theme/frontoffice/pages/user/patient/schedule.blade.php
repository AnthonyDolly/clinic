@extends('theme.frontoffice.layouts.main')

@section('title', 'Agendar una cita')

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/frontoffice/plugins/pickadate/themes/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontoffice/plugins/pickadate/themes/default.date.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontoffice/plugins/pickadate/themes/default.time.css') }}">
@endsection

@section('content')
<div class="container">
    <div class="row">
        @include('theme.frontoffice.pages.user.includes.nav')
        {{-- Seccion principal --}}
        <div class="col s12 m8">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">@yield('title')</span>
                    <form action="" method="post">

                        {{ csrf_field() }}

                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">people</i>
                                <select name="doctor" id="">
                                    <option value="1">Pediatria</option>
                                    <option value="2">Odontología</option>
                                    <option value="3">Neurología</option>
                                </select>
                                <label>Selecciona la Especialidad</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col s12">
                                <i class="material-icons prefix">people</i>
                                <select name="doctor" id="">
                                    <option value="1">Raul</option>
                                    <option value="2">Carlos</option>
                                    <option value="3">Beto</option>
                                </select>
                                <label>Selecciona al doctor</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">today</i>
                                <input type="text" name="date" class="datepicker" id="datepicker" placeholder="Seleccionar Fecha">
                            </div>
                            <div class="input-field col s12 m6">
                                <i class="material-icons prefix">access_time</i>
                                <input type="text" name="time" class="timepicker" id="timepicker" placeholder="Seleccionar Hora">
                            </div>
                        </div>
                        <div class="row">
                            <button class="btn waves-effect waves-light" type="submit">Agendar <i class="material-icons right">send</i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('foot')
    <script src="{{ asset('assets/frontoffice/plugins/pickadate/picker.js') }}"></script>
    <script src="{{ asset('assets/frontoffice/plugins/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('assets/frontoffice/plugins/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('assets/frontoffice/plugins/pickadate/legacy.js') }}"></script>
    <script type="text/javascript">
        $('select').formSelect();
        var input_date = $('.datepicker').pickadate({
            min: true
        });
        var date_picker = input_date.pickadate('picker');

        var input_time = $('.timepicker').pickatime({
            min: 4
        });
        var time_picker = input_time.pickatime('picker');
    </script>
@endsection