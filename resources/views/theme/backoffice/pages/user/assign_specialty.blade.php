@extends('theme.backoffice.layouts.admin')

@section('title','Asignar especialidades')

@section('head')
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('backoffice.user.index') }}">Usuarios del Sistema</a></li>
    <li><a href="{{ route('backoffice.user.show', $user) }}">{{ $user->name}}</a></li>
    <li><a href="" class="active">Asignar especialidades</a></li>
@endsection

@section('content')
    <div class="section">
        <p class="caption">Selecciona las especialidades que deseas asignar</p>
        <div class="divider"></div>
        <div id="basic-form" class="section">
            <div class="row">
                <div class="col s12 m8">
                    <div class="card-panel">
                        <h4 class="header2">Asignar especialidades</h4>
                        <div class="row">
                            <form class="col s12" method="POST" action="{{ route('backoffice.user.specialty_assignment', $user) }}">

                                {{ csrf_field() }}

                                @foreach ($specialties as $specialty)
                                    <p>
                                        <input type="checkbox" id="{{ $specialty->id }}" name="specialties[]" value="{{ $specialty->id }}"
                                        @if ($user->has_specialty($specialty->id)) checked @endif>
                                        <label for="{{ $specialty->id }}">
                                            <span>{{ $specialty->name }}</span>
                                        </label>
                                    </p>
                                @endforeach

                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="btn waves-effect waves-light right" type="submit">Guardar
                                        <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>

                            </form>
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
@endsection