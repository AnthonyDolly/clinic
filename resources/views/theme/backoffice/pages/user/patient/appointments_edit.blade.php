@extends('theme.backoffice.layouts.admin')

@section('title', 'Editar cita de ' . $user->name)

@section('head')
    <link rel="stylesheet" href="{{ asset('assets/frontoffice/plugins/pickadate/themes/default.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontoffice/plugins/pickadate/themes/default.date.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontoffice/plugins/pickadate/themes/default.time.css') }}">
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('backoffice.user.index') }}">Usuarios del sistema</a></li>
    <li><a href="{{ route('backoffice.user.show', $user) }}">{{ $user->name }}</a></li>
    <li><a href="{{ route('backoffice.patient.appointments', $user) }}">{{ 'Citas de ' . $user->name }}</a></li>
    <li><a href=""></a>Editar cita</li>
@endsection

@section('dropdown_settings')
    <li><a href="{{ route('backoffice.patient.schedule', $user) }}" class="grey-text text-darken-2">Editar cita</a></li>
@endsection

@section('content')
<div class="section">
    <p class="caption"><strong>{{ 'Editar Cita de ' . $user->name }}</strong></p>
    <div class="divider"></div>
    <div id="basic-form" class="section">
        <div class="row">
            <div class="col s12 m8">
                <div class="card-panel">
                    <div class="row">
                        @include('theme.includes.user.patient.schedule_form', [
                            'route' => route('backoffice.patient.appointments.update', [
                                $user, $appointment
                            ])
                        ])
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                @include('theme.backoffice.pages.user.includes.user_nav')
            </div>
        </div>
    </div>
</div>
@endsection

@section('foot')
    @include('theme.includes.user.patient.schedule_foot', [
            'material_select' => 'material_select'
    ])
@endsection