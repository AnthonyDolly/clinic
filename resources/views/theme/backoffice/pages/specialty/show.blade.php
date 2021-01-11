@extends('theme.backoffice.layouts.admin')

@section('title', $specialty->name)

@section('head')
@endsection

@section('breadcrumbs')
    <li><a href="{{ route('backoffice.specialty.index') }}">Especialidades médicas</a></li>
    <li><a href="" class="active">{{ $specialty->name }}</a></li>
@endsection

@section('dropdown_settings')
    <li><a href="{{ route('backoffice.specialty.edit', $specialty) }}" class="grey-text text-darken-2">Editar especialidad</a></li>
@endsection

@section('content')
<div class="section">
    <p class="caption"><strong>Especialidad: </strong> {{ $specialty->name }} </p>
    <div class="divider"></div>
    <div id="basic-form" class="section">
        <div class="row">
            <div class="col s12 m8 offset-m2">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title">{{ $specialty->name }}</span>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td><a href="{{ route('backoffice.user.show', $user) }}" target="_blank">{{ $user->name }}</a></td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No hay médicos registrados</td>
                                    </tr>
                                    
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-action">
                        <a href=" {{ route('backoffice.specialty.edit', $specialty) }}">Editar</a>
                        <a href="#" style="color: red" onclick="enviar_formulario()">Eliminar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form method="post" action="{{ route('backoffice.specialty.destroy', $specialty) }}" name="delete_form">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}
</form>
@endsection

@section('foot')
    <script>
        function enviar_formulario()
        {
            Swal.fire({
                title: '¿Desea eliminar esta especialidad?',
                text: 'Esta acción no se puede deshacer',
                icon: 'warning', 
                showCancelButton: true,
                confirmButtonText: 'Si, continuar',
                cancelButtonText: 'No, cancelar',
            }).then((result) => {
                if (result.value) {
                    document.delete_form.submit();
                }else {
                    swal.fire(
                        'operacion cancelada',
                        'Registro no eliminado',
                        'error'
                    )
                }
            })
        }
    </script>
@endsection