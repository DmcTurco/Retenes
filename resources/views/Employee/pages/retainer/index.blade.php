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
                                    <input type="number" class="form-control" name="padron" autofocus>
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

        <div class="card shadow mb-4">
            <div class="card-body">

                <table id="" class="table table-striped table-bordered text-center dts">
                    <thead>
                        <th class="col-sm-1">Numero</th>
                        <th>Padron</th>
                        <th>Fecha y Hora</th>
                        <th class="col-sm-2">Estado</th>
                        <th>Acciones</th>
                    </thead>
                    <tbody>
                        @if ($retainer->count() > 0)
                            @foreach ($retainer as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td> 
                                    <td>Padron: <strong>{{ $item->padron }}</strong></td>
                                    <td>{{ $item->created_at }}</td>
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
@endsection

{{-- @push('styles')
    <link rel="stylesheet" href="{{ asset('libs/datatables/dataTables.bootstrap4.min.css') }}">
@endpush --}}
{{-- 
@push('scripts')
    <script src="{{ asset('/libs/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush --}}

