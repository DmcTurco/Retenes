@extends('admin.layouts.app')

@section('title')
    <span>Empleados</span>
    <a href="" class="btn btn-primary btn-circle OpenModal" data-toggle="modal" data-target="#myModal">
        <i class="fas fa-plus"></i>
    </a>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <table id="dt-employee" class="table table-striped table-bordered text-center dts">

                <thead>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Cel</th>
                    <th>Tipo Doc</th>
                    <th>Num Doc</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    @if ($employees->count() > 0)
                        @foreach ($employees as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->name }}</td>
                                <td>
                                    <span class="text font-weight-bold {{ $item->status == 1 ? 'text-success' : '' }}">
                                        {{ $item->status == 1 ? 'Activo' : 'Inactivo' }}</span>
                                </td>
                                <td>{{ $item->cel ? $item->cel : 'No Hay' }}</td>
                                <td>
                                    <span class="text font-weight-bold {{ $item->doc_type == 1 ? 'text-primary' : '' }}">
                                        {{ $item->doc_type == 1 ? 'DNI' : 'No Hay' }}</span>
                                </td>
                                <td>{{ $item->doc_number ? $item->doc_number : 'No Hay' }}</td>
                                <td>{{ $item->role->name ? $item->role->name : 'No Hay' }}</td>
                                <td>
                                    <a href="" class="edit-form-data OpenModal" data-toggle="modal"
                                        data-target="#myModal" data-head-id="{{ $item->id }}">
                                        <i class="far fa-edit"></i></a>

                                    <a href="" class="delete-form-data" data-toggle="modal"
                                        data-target="#deleteModal"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">No se ha encontrado Categorias registradas</td>
                        </tr>
                    @endif

                </tbody>

            </table>
        </div>
    </div>
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

    @include('admin.pages.employee.form')

    <script>
        $(document).ready(function() {
            initModal('.OpenModal', '/admin/employee/',{
                id:'head-id',
                titleEdit: 'Editar Empleado',
                titleCreate: 'Registrar Empleado',
                submitTextEdit: 'Actualizar',
                submitTextCreate: 'Agregar',
                formId: '#myModal',
                dataTransform: function(response) {return response.employee;}
            });

            initFormSubmission('#myForm', '#myModal');

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
