@extends('theme.frontoffice.layouts.main')

@section('title', 'Mis citas')

@section('head')
@endsection

@section('nav')
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
                    @include('theme.includes.user.patient.appointments_table', [
                        'update' => false
                    ])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('foot')
@endsection