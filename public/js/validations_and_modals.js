function initModal(buttonSelector, dataUrl, options) {
    $(buttonSelector).on('click', function() {
        var id = $(this).data(options.id);
        clearForm(options.formId);
        if (id) {
            $(options.formId + ' #titulo').text(options.titleEdit);
            $(options.formId + ' #submitBtn').text(options.submitTextEdit);
            getData(dataUrl, id, options.formId, options.dataTransform);
        } else {
            $(options.formId + ' #titulo').text(options.titleCreate);
            $(options.formId + ' #submitBtn').text(options.submitTextCreate);
            $(options.formId).modal('show');
        }
    });
}

function getData(url, id, formId, dataTransform) {
    $.ajax({
        type: 'GET',
        dataType: 'JSON',
        url: url + id + '/edit',
        success: function(response) {
            const data =dataTransform ? dataTransform(response) : response;
            fillForm(data, formId);
            $(formId).modal('show');
        },
        error: function(error) {
            console.error('Error al obtener los datos:', error);
        }
    });
}

function fillForm(data, formId) {
    for (const key in data) {
        if (data.hasOwnProperty(key)) {
            $(formId + ' #' + key).val(data[key]);
        }
    }
}

function clearForm(formId) {
    $(formId + ' input').not('[name="_token"]').val('');
    $(formId + ' .invalid-feedback').empty().hide();
    $(formId + ' .form-control').removeClass('is-invalid');
}


function initFormSubmission(formSelector, modalSelector) {
    $(formSelector).submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: formData,
            success: function(response) {
                $(modalSelector).modal('hide');
                if (response.redirect) {
                    window.location.href = response.redirect;
                }
            },
            error: function(response) {
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    $('.invalid-feedback').empty().hide();
                    $('.form-control').removeClass('is-invalid');
                    $.each(errors, function(key, value) {
                        var input = $(formSelector + ' input[name="' + key + '"]');
                        var errorDiv = $(formSelector + ' #' + key + 'Error');
                        input.addClass('is-invalid');
                        errorDiv.text(value[0]).show();
                    });
                    $(modalSelector).modal('show');
                }
            }
        });
    });
}