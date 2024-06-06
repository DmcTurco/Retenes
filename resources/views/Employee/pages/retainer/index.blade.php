@extends('employee.layouts.app')

@section('title')
    <span>>> Retenes</span>
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
                            timer: 1500
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

                <form action="{{ route('employee.retainer.store') }}" method="POST">
                    @csrf
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Ingresa el numero de Padron</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2">
                                <input type="number" class="form-control {{ $errors->has('padron') ? 'is-invalid' : '' }}"
                                    name="padron" autofocus>
                                @if ($errors->has('padron'))
                                    <span class="text-danger">{{ $errors->first('padron') }}</span>
                                @endif
                            </div>

                            <div class="col-md-2">
                                <select name="turns" id="turns" class="form-control">
                                    @foreach ($turns as $item)
                                        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-circle"><i
                                        class="fas fa-plus"></i></button>
                            </div>

                            <div class="col-md-2">

                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <table id="dt-employee" class="table table-striped table-bordered text-center dts">
                        <thead>
                            <th class="col-sm-1">N° Orden</th>
                            <th class="col-sm-2">Padron</th>
                            <th class="col-sm-2">Vuelta</th>
                            <th class="col-sm-3">Estado</th>
                            <th class="col-sm-1">Acciones</th>
                        </thead>
                        <tbody>
                            @php $index1 = 1; @endphp
                            @if ($retainersTurn1->count() > 0)
                                @foreach ($retainersTurn1 as $index => $item)
                                    <tr>
                                        <td>{{ $index1++ }}</td>
                                        <td>Padron: <strong>{{ $item->padron }}</strong></td>
                                        <td>{{ $item->turn_name }}</td>
                                        <td>
                                            <form action="{{ route('employee.updateState', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select class="form-control" name="state" onchange="this.form.submit()">
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
                                            <a href="#" class="delete-form-data" data-id="{{ $item->id }}"><i
                                                    class="far fa-trash-alt"></i></a>
                                            <form id="delete-form-{{ $item->id }}"
                                                action="{{ route('employee.retainer.destroy', $item->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            {{-- <a href="" class="delete-form-data" data-toggle="modal"
                                                data-target="#deleteModal"><i class="far fa-trash-alt"></i></a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            {{-- @else
                                <tr>
                                    <td colspan="5">No se han encontrado Padrones registradas el día de hoy</td>
                                </tr> --}}
                            @endif
                        </tbody>


                    </table>
                </div>
            </div>

        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <table id="dt-employee" class="table table-striped table-bordered text-center dts">
                        <thead>
                            <th class="col-sm-1">N° Orden</th>
                            <th class="col-sm-2">Padron</th>
                            <th class="col-sm-2">Vuelta</th>
                            <th class="col-sm-3">Estado</th>
                            <th class="col-sm-1">Acciones</th>
                        </thead>
                        <tbody>
                            @php $index2 = 1; @endphp
                            @if ($retainersTurn2And3->count() > 0)
                                @foreach ($retainersTurn2And3 as $index => $item)
                                    <tr>
                                        <td>{{ $index2++ }}</td>
                                        <td>Padron: <strong>{{ $item->padron }}</strong></td>
                                        <td>{{ $item->turn_name }}</td>
                                        <td>
                                            <form action="{{ route('employee.updateState', $item->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <select class="form-control" name="state" onchange="this.form.submit()">
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
                                            <a href="#" class="delete-form-data" data-id="{{ $item->id }}"><i
                                                    class="far fa-trash-alt"></i></a>
                                            <form id="delete-form-{{ $item->id }}"
                                                action="{{ route('employee.retainer.destroy', $item->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            {{-- <a href="" class="delete-form-data" data-toggle="modal"
                                                data-target="#deleteModal"><i class="far fa-trash-alt"></i></a> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            {{-- @else
                                <tr>
                                    <td colspan="5">No se han encontrado Padrones registradas el día de hoy</td>
                                </tr> --}}
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
