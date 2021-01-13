<form action="{{ $route }}" method="post">

    {{ csrf_field() }}

    @if (!isset($appointment))

        @if (user()->has_role(config('app.doctor_role')))
            <input type="hidden" name="doctor" value="{{ user()->id }}">        

        @else
            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">people</i>
                    <select name="specialty" id="specialty">
                        <option disabled selected>--Selecciona una especialidad--</option>
                        @foreach ($specialties as $specialty)
                            <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                        @endforeach
                    </select>
                    <label>Selecciona la Especialidad</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <i class="material-icons prefix">people</i>
                    <select name="doctor" id="doctor">
                        <option disabled selected>--Primero selecciona una especialidad--</option>
                    </select>
                    <label>Selecciona al doctor</label>
                </div>
            </div>

        @endif

        

    @else

    <div class="row">
        <div class="input-field col s12">
            <i class="material-icons prefix">hourglass_full</i>
            <select name="status" id="status">
                <option value="pending" @if ($appointment->status == 'pending') selected @endif>Pendiente</option>
                <option value="done" @if ($appointment->status == 'done') selected @endif>Terminada</option>
                <option value="cancelled" @if ($appointment->status == 'cancelled') selected @endif>Cancelada</option>
            </select>
            <label>Selecciona el estado de la cita</label>
        </div>
    </div>

    @endif

    <div class="row">
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">today</i>
            <input type="text" name="date" class="datepicker" id="datepicker" placeholder="Seleccionar Fecha" @if(isset($appointment)) data-value="{{ $appointment->date->format('Y-m-d') }}" @endif>
        </div>
        <div class="input-field col s12 m6">
            <i class="material-icons prefix">access_time</i>
            <input type="text" name="time" class="timepicker" id="timepicker" placeholder="Seleccionar Hora" @if(isset($appointment)) data-value="{{ $appointment->date->format('H:i') }}" @endif>
        </div>
    </div>

    <input type="hidden" name="user_id" value="{{ encrypt($user->id) }}">

    <div class="row">
        <button class="btn waves-effect waves-light" type="submit">Agendar <i class="material-icons right">send</i></button>
    </div>
</form>