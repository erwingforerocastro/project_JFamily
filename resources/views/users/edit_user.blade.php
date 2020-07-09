<div class="container">
    <div class="row">
        <form id="form_edit_user" enctype="multipart/form-data" class="row" method="POST" action="{{ action('UserController@update',['id' => $user->id]) }}">
            {{csrf_field()}}
            <div class="col-md-12">
                   <label class="col-form-label">Identificación: </label>
                   <input type="text" name="identification" id="identification_user" class="form-control" value="{{$user->identification}}">
                </div>
                <div class="col-md-7">
                    <label class="col-form-label">Nombre</label>
                    <input type="text" name="name" id="name_user" class="form-control" value="{{$user->name}}">
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" >Edad</label>
                    <input type="number" name="age" id="age_user" class="form-control" value="{{$user->age}}">
                </div>
                <div class="col-md-6">
                    <label class="col-form-label" >Ocupación</label>
                    <input type="text" name="ocupation" id="ocupation_user" class="form-control"
                        value="{{$user->ocupation}}">
                </div>
                <div class="col-md-6">
                    <label class="col-form-label" >Email</label>
                    <input type="email" name="email" id="email_user" class="form-control" value="{{$user->email}}">
                </div>
                <div class="col-md-12">
                    <label class="col-form-label" >Imagen</label>
                    <input type="file" name="image" id="image_user" class="form-control" value="{{$user->image}}">
                </div>
                <div class="col-md-12 row justify-content-center mt-3">
                    <button class="btn btn-danger" type="submit">Guardar</button>
                </div>
        </form>
    </div>
</div>
<script>
    $('#form_edit_user').validate({
        submitHandler: function(form) {
                let html = "<p class='text-center mx-auto'>¿Seguro que quiere guardar?</p>"
                bootbox.confirm({
                    message: html,
                    buttons: {
                        confirm: {
                            label: 'Todo es correcto, enviar!',
                            className: 'btn-outline-success'
                        },
                        cancel: {
                            label: 'Corregir información',
                            className: 'btn-outline-danger'
                        }
                    },
                    callback: function(result) {
                        if (result) {
                            form.submit();
                        }
                    }
                });
            return false;
        },
        rules: {
            identification: {
                required: true,
                number:true,
            },
            name: {
                required: true,
            },
            email:{
                required:true,
            },
            age: {
                required: true,
                number:true,
                min: 1,
            },
        },
        messages: {
            identification: {
                required: 'La identificación es requerida',
                number:'La identificación debe ser un numero',
            },
            nombre: {
                required: "El nombre del usuario es requerido"
            },
            email:{
                required:'El email del usuario es requerido'
            },
            age: {
                required: 'La edad del usuario es requerido',
                number:'la edad debe ser un numero',
                min: 'La edad minima de un usuario es 1',
            }
        },
        highlight: function(element, errorClass) {
            $(element).parent().addClass('has-feedback has-error');
            $(element).parent().removeClass('has-feedback has-success');
        },
        unhighlight: function(element, errorClass) {
            $(element).parent().removeClass('has-feedback has-error');
            $(element).parent().addClass('has-feedback has-success');
        },
        errorPlacement: function(error, element) {
            if (element.hasClass("no-label")) {} else if (element.parents('.input-group').length > 0) {
                error.insertAfter(element.parents('.input-group'));
            } else if (element.parents('.form-group').find('.chosen-container').length > 0) {
                error.parent().insertAfter(element);
            } else if (element.parents('.radio').find('.chosen-container').length > 0) {
                error.insertAfter(element.parents('.radio').find('.chosen-container'));
            } else {
                error.insertAfter(element);
            }
        }
    });
    
    $("input[type='number']").on({
				"focus": function(event) {
					$(event.target).select();
				},
				"keyup": function(event) {
					$(event.target).val(function(index, value) {
						return value.replace(/\D/g, "");
					});
				}
	});

    $("input[type='text'][id!='identification_user']").on({
				"focus": function(event) {
					$(event.target).select();
				},
				"keyup": function(event) {
					$(event.target).val(function(index, value) {
						return value.replace(/\d/g, "");
					});
				}
	});

</script>