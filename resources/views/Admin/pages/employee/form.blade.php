<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="h3 text-info d-sm-flex align-items-center mb-0">
                    <span class="display-3 mr-2">≫</span>
                    <span id="titulo"></span>
                </div>
                {{-- <h5 id="titulo" class="modal-title text-inspinia text-primary"></h5> --}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.employee.store') }}" role="form" method="POST" id="">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <div>
                                <label for="name" class="form-fields">Nombre</label>
                                <label class="mandatory-field">*</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    value="{{ old('name') }}" autofocus>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <div>
                                <label for="email" class="form-fields">correo</label>
                                <label class="mandatory-field">*</label>
                                <input type="text" class="form-control" name="email" id="email"
                                    value="{{ old('email') }}">
                            </div>
                        </div>
                        <div class="col-lg-6 form-group">
                            <div>
                                <label for="password" class="form-fields">Contraseña</label>
                                <label class="mandatory-field">*</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <div>
                                <label for="doc_type" class="form-fields">Tipo Doc.</label>
                                <label class="mandatory-field">*</label>
                                <select class="form-control" name="doc_type" id="doc_type">
                                    <option value="1">DNI</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6 form-group">
                            <div>
                                <label for="doc_number" class="form-fields">Numero Doc.</label>
                                <label class="mandatory-field">*</label>
                                <input type="text" class="form-control" name="doc_number" id="doc_number"
                                    value="{{ old('doc_number') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <div>
                                <label for="cel" class="form-fields">cel</label>
                                <label class="mandatory-field">*</label>
                                <input type="text" class="form-control" name="cel" id="cel"
                                    value="{{ old('cel') }}">
                            </div>
                        </div>
                        <div class="col-lg-6 form-group">
                            <div>
                                <label for="status" class="form-fields">Estado</label>
                                <label class="mandatory-field">*</label>
                                <select class="form-control" name="status" id="status">
                                    <option value="1">Activo</option>
                                    <option value="2">Inactivo</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="buttons-form-submit d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary mr-1" data-dismiss="modal">Cerrar</button>
                        <button id="submitBtn" type="submit" href="#" class="btn btn-primary">
                            Guardar
                            <i class="fas fa-spinner fa-spin d-none"></i>
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
