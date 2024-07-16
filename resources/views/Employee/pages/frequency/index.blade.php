@extends('employee.layouts.app')

@section('title')
    <span>>> Frecuencia</span>
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3 class="d-flex justify-content-center align-items-center"><strong>Ingresa la hora para calcular la
                            Frecuencia</strong></h3>
                    <h5 class="d-flex justify-content-center align-items-center">Frecuencia Actual : <strong><span
                                id="reloj-name">Nombre del Reloj</span></strong></h5>
                    <label for="" class="d-flex justify-content-center align-items-center"><span
                            id="reloj-number_minutes">Minutos</span></label>

                    <div class="container">
                        <div class="row d-flex justify-content-center align-items-center">
                            <div class="col-md-4 ">
                                <input id="initial-time" type="time" class="form-control text-center" 
                                    style="font-size: 1.5rem; padding: 1.5rem; height: auto;" value="00:00">
                            </div>
                        </div>
                        <br>
                        <hr>
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-md-4">
                            <input id="time-with-minutes-1" type="time" class="form-control text-center"
                                style="font-size: 1.5rem; padding: 1.5rem; height: auto;" readonly>
                        </div>
                        <div class="col-md-4">
                            <input id="time-with-minutes-2" type="time" class="form-control text-center"
                                style="font-size: 1.5rem; padding: 1.5rem; height: auto;" readonly>
                        </div>
                        <div class="col-md-4">
                            <input id="time-with-minutes-3" type="time" class="form-control text-center"
                                style="font-size: 1.5rem; padding: 1.5rem; height: auto;" readonly>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function updateFrequency() {
                $.ajax({
                    url: '{{ route('employee.frequency.index') }}',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data.length > 0) {
                            var reloj = data[0];
                            $('#reloj-name').text(reloj.name);
                            $('#reloj-number_minutes').text(
                                `${reloj.number_minutes_1}-${reloj.number_minutes_2}-${reloj.number_minutes_3}`
                                );
                            // Capturar el valor del input de tiempo inicial
                            var initialTime = $('#initial-time').val();
                            var time = new Date(`1970-01-01T${initialTime}:00`);
                            // Sumar number_minutes_1
                            time.setMinutes(time.getMinutes() + parseInt(reloj.number_minutes_1));
                            $('#time-with-minutes-1').val(time.toTimeString().substring(0, 5));
                            // Sumar number_minutes_2
                            time.setMinutes(time.getMinutes() + parseInt(reloj.number_minutes_2));
                            $('#time-with-minutes-2').val(time.toTimeString().substring(0, 5));
                            // Sumar number_minutes_3
                            time.setMinutes(time.getMinutes() + parseInt(reloj.number_minutes_3));
                            $('#time-with-minutes-3').val(time.toTimeString().substring(0, 5));
                        } else {
                            $('#reloj-name').text('No hay registros en el rango de tiempo actual.');
                            $('#time-with-minutes-1').val('00:00');
                            $('#time-with-minutes-2').val('00:00');
                            $('#time-with-minutes-3').val('00:00');
                        }
                    }
                });
            }

            // Actualizar cada 60 segundos
            setInterval(updateFrequency, 60000);

            // Actualizar al cargar la página
            updateFrequency();

            // Actualizar los tiempos cuando se cambia el valor del input inicial
            $('#initial-time').on('change', function() {
                updateFrequency();
            });
        });
    </script>
@endsection
