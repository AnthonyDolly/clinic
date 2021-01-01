@extends('theme.backoffice.layouts.admin')

@section('title','pagina demo')

@section('head')
@endsection

@section('breadcrumbs')
    {{-- <li><a href="{{ route('backoffice.role.index') }}">Roles del Sistema</a></li> --}}
@endsection

@section('dropdown_settings')
    {{-- <li><a href="{{ route('backoffice.role.create') }}" class="grey-text text-darken-2">Crear rol</a></li> --}}
@endsection

@section('content')
    <p>Hola desde la vista demo</p>
@endsection

@section('foot')
    
@endsection