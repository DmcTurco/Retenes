@extends('employee.layouts.app')

@section('title', 'Retenes')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <form action="{{ route('employee.retainer.store') }}" method="POST">
                        @csrf
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Ingresa el numero de Padron</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <input type="number" class="form-control" name="padron" autofocus >
                                    @if ($errors->has('padron'))
                                        <span class="text-danger">{{ $errors->first('padron') }}</span>
                                    @endif
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary btn-circle"><i
                                            class="fas fa-plus"></i></button>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <table id="dt-category" class="table table-striped table-bordered text-center dts">

                            <thead>
                                <th>Padron</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </thead>
                            <tbody>
                                @if ($retainer->count() > 0)
                                    @foreach ($retainer as $item)
                                        <tr>
                                            <td>{{ $item->padron }}</td>
                                            <td>{{ $item->state }}</td>
                                            <td>
                                                {{-- <a href="" class="edit-form-data" data-toggle="modal" data-target="#editModal"
                                                onclick="editCategory({{ $item }})">
                                                <i class="far fa-edit"></i></a> --}}
                                                <a href="" class="delete-form-data" data-toggle="modal"
                                                    data-target="#deleteModal"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="4">No se han encontrado Padrones registradas el dia de hoy</td>
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

@push('styles')
    <link rel="stylesheet" href="{{ asset('libs/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('/libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
@endpush
