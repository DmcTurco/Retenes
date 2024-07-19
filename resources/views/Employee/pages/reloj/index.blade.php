@extends('employee.layouts.app')

@section('title')
    <span>>> Reloj</span>
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                @if (session('message'))
                    <script>
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "Información",
                            text: "{{ session('message') }}",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                @endif
                @if (session('warning'))
                    <script>
                        Swal.fire({
                            position: "top-center",
                            icon: 'warning',
                            title: 'Registro Duplicado',
                            text: "{{ session('warning') }}",
                            showConfirmButton: false,
                            timer: 2500
                        });
                    </script>
                @endif
                @if (session('delete'))
                    <script>
                        Swal.fire({
                            position: "top-center",
                            icon: "success",
                            title: "Información",
                            text: "{{ session('delete') }}",
                            showConfirmButton: false,
                            timer: 1500
                        });
                    </script>
                @endif

                <form action="{{ route('employee.reloj.store') }}" method="POST">
                    @csrf
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Registre sus relojes</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="name">Detalle</label>
                                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}"
                                    name="name" autofocus>
                                @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>

                            <div class="col-md-2">

                                <label for="star_time">Hora Inicio</label>
                                <input type="time" class="form-control {{ $errors->has('star_time') ? 'is-invalid' : '' }}" value="{{ old('star_time') }}"
                                    name="star_time" autofocus>
                                @if ($errors->has('star_time'))
                                    <span class="text-danger">{{ $errors->first('star_time') }}</span>
                                @endif

                            </div>
                            <div class="col-md-2">
                                <label for="end_time">Hora Final</label>
                                <input type="time" class="form-control {{ $errors->has('end_time') ? 'is-invalid' : '' }}" value="{{ old('end_time') }}"
                                    name="end_time" autofocus>
                                @if ($errors->has('end_time'))
                                    <span class="text-danger">{{ $errors->first('end_time') }}</span>
                                @endif
                            </div>
                            <div class="col-md-1">
                                <label for="number_minutes_1">Reloj #1</label> 
                                <input type="number" class="form-control {{ $errors->has('number_minutes_1') ? 'is-invalid' : '' }}" value="{{ old('number_minutes_1') }}"
                                    name="number_minutes_1" autofocus>
                                @if ($errors->has('number_minutes_1'))
                                    <span class="text-danger">{{ $errors->first('number_minutes_1') }}</span>
                                @endif
                            </div>
                            <div class="col-md-1">
                                <label for="number_minutes_2">Reloj #2</label>
                                <input type="number" class="form-control {{ $errors->has('number_minutes_2') ? 'is-invalid' : '' }}" value="{{ old('number_minutes_2') }}"
                                    name="number_minutes_2" autofocus>
                                @if ($errors->has('number_minutes_2'))
                                    <span class="text-danger">{{ $errors->first('number_minutes_2') }}</span>
                                @endif
                            </div>
                            <div class="col-md-1">
                                <label for="number_minutes_3">Reloj #3</label>
                                <input type="number" class="form-control {{ $errors->has('number_minutes_3') ? 'is-invalid' : '' }}" value="{{ old('number_minutes_3') }}"
                                    name="number_minutes_3" autofocus>
                                @if ($errors->has('number_minutes_3'))
                                    <span class="text-danger">{{ $errors->first('number_minutes_3') }}</span>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <br>
                                <button type="submit" class="btn btn-primary btn-circle"><i
                                    class="fas fa-plus"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <table id="dt-employee" class="table table-striped table-bordered text-center dts">
                        <thead>
                          
                            <th class="col-sm-3">Detalles</th>
                            <th class="col-sm-1">Hora inicio</th>
                            <th class="col-sm-1">Hora Final</th>
                            <th class="col-sm-1">Minuto 1</th>
                            <th class="col-sm-1">Minuto 2</th>
                            <th class="col-sm-1">Minuto 3</th>
                            <th class="col-sm-2">Estado</th>
                            <th class="col-sm-1">Acciones</th>
                        </thead>
                        <tbody>

                            @if ($relojes->count() > 0)
                                @foreach ($relojes as $reloj)
                                    <tr>
                                        <td>{{ $reloj->name }}</td>
                                        <td>{{ date('H:i', strtotime($reloj->star_time)) }}</td>
                                        <td>{{ date('H:i', strtotime($reloj->end_time)) }}</td>
                                        <td>{{ $reloj->number_minutes_1 }}</td>
                                        <td>{{ $reloj->number_minutes_2 }}</td>
                                        <td>{{ $reloj->number_minutes_3 }}</td>
                                        <td>                                                      
                                            <span class="text font-weight-bold {{ $reloj->state == 1 ? 'text-success' : '' }}" > {{ $reloj->state == 1 ? 'Activo' : 'Inactivo' }}</span>
                                        <td>
                     
                                            <a href="" class="edit-form-data" data-toggle="modal" data-target="#editModal">
                                                <i class="far fa-edit"></i>
                                            </a>

                                            <form id="delete-form-{{ $reloj->id }}"
                                                action="{{ route('employee.retainer.destroy', $reloj->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a href="" class="delete-form-data" data-toggle="modal"
                                                data-target="#deleteModal"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="5">No se han encontrado Padrones registradas el día de hoy</td>
                                </tr>
                            @endif
                        </tbody>


                    </table>
                </div>
            </div>

        </div>

    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteLinks = document.querySelectorAll('.delete-form-data');
            deleteLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const id = this.getAttribute('data-id');

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "No podrás revertir esto!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, eliminarlo!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            const deleteForm = document.getElementById('delete-form-' + id);
                            deleteForm.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('libs/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('/libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush
