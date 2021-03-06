<script src="{{ asset('assets/frontoffice/plugins/pickadate/picker.js') }}"></script>
    <script src="{{ asset('assets/frontoffice/plugins/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('assets/frontoffice/plugins/pickadate/picker.time.js') }}"></script>
    <script src="{{ asset('assets/frontoffice/plugins/pickadate/legacy.js') }}"></script>
    <script type="text/javascript">
        
        var input_date = $('.datepicker').pickadate({
            min: true,
            formatSubmit: 'yyyy-m-d'
        });
        var date_picker = input_date.pickadate('picker');

        var input_time = $('.timepicker').pickatime({
            min: [7,30],
            max: [21,0],
            formatSubmit: 'HH:i'
        });
        var time_picker = input_time.pickatime('picker');

        $('select').{!! $material_select !!}();

        var specialty = $('#specialty');
        var doctor = $('#doctor');

        specialty.change(function() {
            $.ajax({
                url: '{{ route('ajax.user_specialty') }}',
                method: 'GET',
                data: {
                    specialty: specialty.val(),
                },
                success: function(data) {
                    doctor.empty();

                    doctor.append('<option disabled selected>--Selecciona un médico--</option>');

                    $.each(data, function(index, element) {
                        doctor.append('<option value="' + element.id + '"> ' + element.name  + '</option>');
                    });

                    doctor.{!! $material_select !!}();
                }
            });
        });

        doctor.change(function() {
            date_picker.set({
                disable: [
                    [2021,0,21]
                ],
            });

            time_picker.set({
                min: [7,30],
                max: [21,0],
                disable: [
                    { from: [14,0], to: [15,30]},
                    [10,0],
                ]
            });
        });

</script>