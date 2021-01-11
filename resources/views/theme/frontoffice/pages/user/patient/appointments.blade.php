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
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Especialista</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->id }}</td>
                                    <td>{{ $appointment->doctor()->name }}</td>
                                    <td>{{ $appointment->date->format('d/m/Y H:i') }}</td>
                                    <td>{{ $appointment->status }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No hay citas registradas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('foot')
@endsection