@extends('admin.layouts.app')

@section('title')
    <span>Empleados</span>
    <a href="" class="btn btn-primary btn-circle OpenModal" data-toggle="modal" data-target="#myModal">
        <i class="fas fa-plus"></i>
    </a>
@endsection

@section('content')

    @include('admin.pages.employee.form')
    @if (session('message'))
        <script>
            Swal.fire({
                position: "top",
                icon: "success",
                title: "Información",
                text: "{{ session('message') }}",
                showConfirmButton: false,
                timer: 1500
            });
        </script>

    @endif
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
                    <th>Acciones</th>
                </thead>
                <tbody>
                    @if ($employee->count() > 0)
                        @foreach ($employee as $item)
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
                            <td colspan="4">No se ha encontrado Categorias registradas</td>
                        </tr>
                    @endif

                </tbody>

            </table>
        </div>
    </div>

    {{-- <script>
        $(document).ready(function() {
            var successMessage = '{{ Session::get('success') }}';
            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: successMessage,
                });
            }
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            $('.OpenModal').on('click', function() {
                var headId = $(this).data('head-id');
                clearForm();
                if (headId) {
                    $('#titulo').text('Editar Empleado');
                    $('#submitBtn').text('Actualizar');
                    getHeadHeadQuarter(headId);
                } else {
                    $('#titulo').text('Registrar Empleado');
                    $('#submitBtn').text('Agregar');
                    $('#myModal').modal('show');
                }
            });
        });

        function getHeadHeadQuarter(id) {

            $.ajax({
                type: 'GET',
                dataType: 'JSON',
                url: '/admin/employee/' + id + '/edit',

                success: function(response) {
                    $('#id').val(response.employee.id);
                    $('#name').val(response.employee.name);
                    $('#email').val(response.employee.email);
                    $('#doc_type').val(response.employee.doc_type);
                    $('#doc_number').val(response.employee.doc_number);
                    $('#cel').val(response.employee.cel);
                    $('#status').val(response.employee.status);
                    $('#myModal').modal('show');
                },
                error: function(error) {
                    console.error('Error al obtener los datos del Empleado:', error);
                }
            });
        }

        function clearForm() {
            $('#id').val('');
            $('#name').val('');
            $('#email').val('');
            $('#password').val('');
            $('#doc_number').val('');
            $('#cel').val('');
        }
    </script>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('libs/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('/libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush
