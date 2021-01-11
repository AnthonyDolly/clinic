@extends('theme.backoffice.layouts.admin')

@section('title','Especialidades Médicas')

@section('head')
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('backoffice.specialty.index') }}">Especialidades médicas</a></li>
@endsection

@section('dropdown_settings')
    <li><a href="{{ route('backoffice.specialty.create') }}" class="grey-text text-darken-2">Crear especialidad</a></li>
@endsection

@section('content')
<div class="section">
    <p class="caption"><strong>Especialidades médicas</strong></p>
    <div class="divider"></div>
    <div id="basic-form" class="section">
        <div class="row">
            <div class="col s12">
                <div class="card-panel">
                    <div class="row">
                        <table>
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Nro. Medicos</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($specialties as $specialty)
                                    <tr>
                                        <td><a href="{{ route('backoffice.specialty.show', $specialty) }}">{{ $specialty->name }}</a></td>
                                        <td>{{ $specialty->users->count() }}</td>
                                        <td><a href="{{ route('backoffice.specialty.edit', $specialty) }}">Editar</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('foot')
@endsection