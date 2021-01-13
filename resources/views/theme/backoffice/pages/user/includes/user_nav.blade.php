<div class="collection">
    {{--<a href="#" class="collection-item active">Alvin</a>--}}
    <a href="{{ route('backoffice.user.show', $user) }}" class="collection-item active">{{ $user->name }}</a>
    @if (Auth::user()->has_any_role([
        config('app.admin_role'),
        config('app.doctor_role'),
        config('app.secretary_role')
    ]))
        @if ($user->has_role(config('app.patient_role')))
            <a href="{{ route('backoffice.patient.schedule', $user) }}" class="collection-item">Agendar Cita</a>
            <a href="{{ route('backoffice.patient.appointments', $user) }}" class="collection-item">Citas</a>
            <a href="{{ route('backoffice.patient.invoices', $user) }}" class="collection-item">Facturas</a>
        @endif
        @if ($user->has_role(config('app.doctor_role')))
            <a href="{{ route('backoffice.doctor.appointments.show', $user) }}" class="collection-item">Citas</a>
        @endif
    @endif

    @if (Auth::user()->has_role(config('app.admin_role')))
        <a href="{{ route('backoffice.user.assign_role', $user) }}" class="collection-item">Asignar roles</a>
        <a href="{{ route('backoffice.user.assign_permission', $user) }}" class="collection-item">Asignar Permisos</a>
        @if ($user->has_role(config('app.doctor_role')))
            <a href="{{ route('backoffice.user.assign_specialty', $user) }}" class="collection-item">Asignar especialidad</a>
        @endif
    @endif
</div>