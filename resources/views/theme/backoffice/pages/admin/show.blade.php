@extends('theme.backoffice.layouts.admin')

@section('title','Panel de Administración')

@section('head')
@endsection

@section('breadcrumbs')
    {{-- <li><a href="{{ route('backoffice.role.index') }}">Roles del Sistema</a></li> --}}
@endsection

@section('dropdown_settings')
    {{-- <li><a href="{{ route('backoffice.role.create') }}" class="grey-text text-darken-2">Crear rol</a></li> --}}
@endsection

@section('content')
    <p>Panel de Administración</p>
@endsection

@section('foot')
    
@endsection