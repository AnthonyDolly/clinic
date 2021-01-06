@extends('theme.frontoffice.layouts.main')

@section('title', 'Editar perfil')

@section('head')
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
                    <div class="row">
                        <form action="{{ route('frontoffice.user.update', [$user, 'view=frontoffice']) }}" method="post" class="col s12">
                            
                            {{ csrf_field() }}
                            {{ method_field('PUT')}}

                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="text" name="name" id="name" value="{{ $user->name }}">
                                    <label for="name">Nombre de usuario</label>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="date" name="dob" id="dob" value="{{ $user->dob->format('Y-m-d') }}">
                                    <label for="dob">Fecha de nacimiento</label>
                                    @error('dob')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <input type="email" name="email" id="email" value="{{ $user->email }}">
                                    <label for="email">Email</label>
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light right" type="submit">Actualizar
                                        <i class="material-icons right">send</i>
                                    </button>
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