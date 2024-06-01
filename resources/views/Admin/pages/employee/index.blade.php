@extends('admin.layouts.app')

@section('title')
    <span>Empleados</span>
    <a href="" class="btn btn-primary btn-circle" data-toggle="modal" data-target="#createMdl">
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
                <th>Acciones</th>
            </thead>
            <tbody>
                {{-- @if ($category->count() > 0)
                    @foreach ($category as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->state }}</td>
                            <td>
                                <a href="" class="edit-form-data" data-toggle="modal" data-target="#editModal"
                                    onclick="editCategory({{ $item }})">
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
                @endif --}}

            </tbody>

        </table>
    </div>
</div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('libs/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('/libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>

@endpush
