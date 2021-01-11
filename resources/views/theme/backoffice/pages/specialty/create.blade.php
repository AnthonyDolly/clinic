@extends('theme.backoffice.layouts.admin')

@section('title','Crear especialidad')

@section('head')
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('backoffice.specialty.index') }}">Especialidades médicas</a></li>
    <li><a href="" class="active">Crear especialidad</a></li>
@endsection

@section('content')
    <div class="section">
        <p class="caption">Introduce los datos para crear una nueva especialidad médica.</p>
        <div class="divider"></div>
        <div id="basic-form" class="section">
            <div class="row">
                <div class="col s12 m8 offset-m2">
                    <div class="card-panel">
                        <h4 class="header2">Crear Especialidad</h4>
                        <div class="row">
                            <form class="col s12" method="POST" action="{{ route('backoffice.specialty.store') }}">

                                {{ csrf_field() }}

                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="name" type="text" name="name">
                                        <label for="name">Nombre de la especialidad</label>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <button class="btn waves-effect waves-light right" type="submit">Guardar
                                            <i class="material-icons right">send</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('foot')
@endsection