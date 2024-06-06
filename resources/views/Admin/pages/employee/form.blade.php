<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-backdrop="static" data-keyboard="false">
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
                <form action="{{ route('admin.employee.store') }}" role="form" method="POST" id="myForm">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 form-group">
                            <div>
                                <label for="name" class="form-fields">Nombre</label>
                                <label class="mandatory-field">*</label>
                                <input type="text"
                                    class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" name="name"
                                    id="name" value="{{ old('name') }}" >
                                <div class="invalid-feedback" id="nameError"></div>
                                {{-- @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif --}}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <div>
                                <label for="email" class="form-fields">correo</label>
                                <label class="mandatory-field">*</label>
                                <input type="text"
                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email"
                                    id="email" value="{{ old('email') }}">
                                <div class="invalid-feedback" id="emailError"></div>
                                {{-- @if ($errors->has('email'))
                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif --}}
                            </div>
                        </div>
                        <div class="col-lg-6 form-group">
                            <div>
                                <label for="password" class="form-fields">Contraseña</label>
                                <label class="mandatory-field">*</label>
                                <input type="password"
                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                    name="password" id="password" value="">
                                <div class="invalid-feedback" id="passwordError"></div>
                                {{-- @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif --}}
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



<script>
    $('#myForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function(response) {
                $('#myModal').modal('hide');
                window.location.href = response.redirect;
                // Swal.fire({
                //     title: 'Éxito',
                //     text: 'Empleado creado exitosamente.',
                //     icon: 'success',
                //     showConfirmButton: false,
                //     timer: 1500
                // })
            },
            error: function(response) {
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    $('.invalid-feedback').empty().hide();
                    $('.form-control').removeClass('is-invalid');
                    $.each(errors, function(key, value) {
                        var input = $('input[name="' + key + '"]');
                        var errorDiv = $('#' + key + 'Error');
                        input.addClass('is-invalid');;
                        errorDiv.text(value[0]).show();
                    });
                    $('#myModal').modal('show');
                }
            }
        });
    });
</script>
