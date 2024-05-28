@extends('employee.layouts.app')

@section('title', '>> Historial ')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Seleccione una Fecha para poder Realiza la busqueda
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <input id="dateInput" type="date" class="form-control" name="date" value="">
                            </div>
                            <div class="col-md-2">
                                <button type="button" id="searchButton" class="btn btn-primary btn-circle"> <i
                                        class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <table id="" class="table table-striped table-bordered text-center dts">
                            <thead>
                                <th class="col-sm-1">N° Orden</th>
                                <th class="col-sm-2">Padron</th>
                                <th class="col-sm-2">Vuelta</th>
                                <th class="col-sm-3">Estado</th>
                                <th class="col-sm-3">Acciones</th>
                            </thead>
                            <tbody>
                                @php $index1 = 1; @endphp
                                @if (!empty($retainersTurn1) && $retainersTurn1->count() > 0)
                                    @foreach ($retainersTurn1 as $index => $item)
                                        <tr>
                                            <td>{{ $index1++ }}</td>
                                            <td>Padron: <strong>{{ $item->padron }}</strong></td>
                                            <td>{{ $item->turn_name }}</td>
                                            <td>
                                                <form action="{{ route('employee.updateState', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select class="form-control" name="state"
                                                        onchange="this.form.submit()">
                                                        <option value="1" {{ $item->state == '1' ? 'selected' : '' }}>
                                                            En cola</option>
                                                        <option value="2" {{ $item->state == '2' ? 'selected' : '' }}>
                                                            Salió</option>
                                                        <option value="3" {{ $item->state == '3' ? 'selected' : '' }}>
                                                            Voló</option>
                                                        <option value="4" {{ $item->state == '4' ? 'selected' : '' }}>
                                                            Falla mecánica</option>
                                                    </select>
                                                </form>
                                            </td>

                                            <td>
                                                {{ $item->created_at }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">No se han encontrado Padrones registradas el día</td>
                                    </tr>
                                @endif
                            </tbody>


                        </table>
                    </div>
                </div>

            </div>
            <div class="col-lg-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <table id="" class="table table-striped table-bordered text-center dts">
                            <thead>
                                <th class="col-sm-1">N° Orden</th>
                                <th class="col-sm-2">Padron</th>
                                <th class="col-sm-2">Vuelta</th>
                                <th class="col-sm-3">Estado</th>
                                <th class="col-sm-3">Fecha</th>
                            </thead>
                            <tbody>
                                @php $index2 = 1; @endphp
                                @if (!empty($retainersTurn2And3) && $retainersTurn2And3->count() > 0)
                                    @foreach ($retainersTurn2And3 as $index => $item)
                                        <tr>
                                            <td>{{ $index2++ }}</td>
                                            <td>Padron: <strong>{{ $item->padron }}</strong></td>
                                            <td>{{ $item->turn_name }}</td>
                                            <td>
                                                <form action="{{ route('employee.updateState', $item->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <select class="form-control" name="state"
                                                        onchange="this.form.submit()">
                                                        <option value="1" {{ $item->state == '1' ? 'selected' : '' }}>
                                                            En cola</option>
                                                        <option value="2" {{ $item->state == '2' ? 'selected' : '' }}>
                                                            Salió</option>
                                                        <option value="3" {{ $item->state == '3' ? 'selected' : '' }}>
                                                            Voló</option>
                                                        <option value="4" {{ $item->state == '4' ? 'selected' : '' }}>
                                                            Falla mecánica</option>
                                                    </select>
                                                </form>
                                            </td>

                                            <td>
                                                {{ $item->created_at }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">No se han encontrado Padrones registradas el día</td>
                                    </tr>
                                @endif
                            </tbody>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
 document.addEventListener('DOMContentLoaded', function () {
        const dateInput = document.getElementById('dateInput');
        const searchButton = document.getElementById('searchButton');
        // const selectedDate = localStorage.getItem('selectedDate');

        // if(selectedDate) {
        //     dateInput.value = selectedDate;
        // }

        searchButton.addEventListener('click', function() {
            const dateValue = dateInput.value;

            if (dateValue) {
                const today = new Date();
                const selectedDate = new Date(dateValue);
                if (selectedDate > today) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Fecha Futura',
                        text: 'La fecha seleccionada es mayor que la fecha de hoy.',
                        confirmButtonText: 'Aceptar'
                    });
                } else {
                    // Almacenar la fecha seleccionada en el localStorage
                    // localStorage.setItem('selectedDate', dateValue);
                    const url = `{{ route('employee.getRetainer', ['date' => ':date']) }}`.replace(':date', dateValue);
                    window.location.href = url;
                }

            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Por favor seleccione una fecha.',
                    confirmButtonText: 'Aceptar'
                });
            }
        });
    });
</script>