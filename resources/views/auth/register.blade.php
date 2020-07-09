@extends('layouts.app_personalized')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registro de usuario</div>

                <div class="card-body">
                    <form id="form_register_user" onsubmit="event.preventDefault();">
                        <div class="form-group row">
                            <label for="identification" class="col-md-4 col-form-label text-md-right">Identificación:
                            </label>

                            <div class="col-md-6">
                                <input id="identification" type="text" class="form-control" name="identification"
                                    value="{{ old('identification') }}" required autocomplete="identification"
                                    autofocus placeholder="CC NIT etc..">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nombre:</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}"
                                    required autocomplete="name" autofocus placeholder="Usuario">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">Celular:</label>
                            <div class="col-md-6">
                                <input id="phone" type="number" class="form-control" name="phone"
                                    value="{{ old('phone') }}" required autocomplete="phone" autofocus placeholder="3005234350">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">Edad:</label>
                            <div class="col-md-6">
                                <input id="age" type="number" class="form-control" name="age" value="{{ old('age') }}"
                                    required autocomplete="age" autofocus placeholder="00">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ocupation" class="col-md-4 col-form-label text-md-right">Ocupación:</label>
                            <div class="col-md-6">
                                <input id="ocupation" type="text" class="form-control" name="ocupation"
                                    value="{{ old('ocupation') }}" autocomplete="ocupation" autofocus placeholder="Ejem: Medico">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email"
                                    value="{{ old('email') }}" required autocomplete="email" placeholder="Ejem: usuario@correo.com">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña:</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required
                                    autocomplete="new-password" placeholder="************">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar
                                Contraseña:</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password" placeholder="************">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('/js/bootbox.all.min.js')}}"></script>
<script>
    $('input#identification').blur( (e) => { 
        let link=`{{url('usuario-validar')}}/${$('input#identification').val()}`
        $.ajax({
            type: "GET",
            url: link,
            success: function (data) {
                console.log(data);
                if(data!=null && data.length!=0 && data!=''){
                    if(data.creation){
                        bootbox.alert('El usuario ya se encuentra registrado!')
                        $('input[id!="identification"]').attr('disabled', true);
                        $('button[type="submit"]').hide()
                    }else{
                        Object.keys(data).map(key=>{
                            $(`#${key}`).val(data[key]) 
                            console.log($(`#${key}`).val())
                        })
                    }
                     
                }else{
                    $('input').attr('disabled', false);
                    $('button[type="submit"]').show()
                }
            }
        });
    });

    let internal_validation=[false,false]

    const validatePassword=(pass)=>{
        [...pass].map(c=>{  
            internal_validation[0]=(internal_validation[0])?internal_validation[0]:(c.match(/[A-Z]/)!=null)
            internal_validation[1]=(internal_validation[1])?internal_validation[1]:(!isNaN(Number(c)))
            })
        return internal_validation[0]==internal_validation[1]
    }

    $('#form_register_user').validate({
        submitHandler: function(form) {
             if(!validatePassword($('input#password').val())){
                 return bootbox.alert('contraseña incorrecta es necesario que tenga  minimo 1 mayuscula y 1 numero')
             }else{
             let link='{{url("register")}}'
             $.ajax({
                 url: link,
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 type: 'POST',
                 data: $('#form_register_user').serialize(),
                 success: function(data) {
                     window.location.replace("/usuario");
                 },
                 error: function() {
                     bootbox.alert("Ah ocurrido un error, intentelo de nuevo");
                     console.log("error al crear el usuario");
                 }
             });
            }            
            return false;
        },
        rules: {
            name: {
                required: true,
            },
            identification:{
                required:true,
            },
            phone:{
                required:true,
                minlength:5
            },
            age: {
                required: true,
            },
            email:{
                required:true,
            },
            password:{
                required:true,
                minlength:8,

            },
            password_confirmation: {
                required:true,
                equalTo: "#password"
            }
            
        },
        messages: {
            name: {
                required: "El nombre del usuario es requerido"
            },
            identification:{
                required:"La identificacion es requerida",
            },
            phone:{
                required:"El telefono es requerido",
                minlength:"El telefono debe tener mas de 5 numeros"
            },
            age: {
                required: "La edad es requerida",
            },
            email:{
                required:'El email del usuario es requerido'
            },
            password:{
                required:"La contraseña es requerida",
                minlength:'La contraseña debe tener minimo 8 caracteres'
            },
            password_confirmation: {
                required:"la confirmacion de la contraseña es requerida",
                equalTo: "Las contraseñas deben ser iguales"
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

    $("input[type='text'][id!='identification']").on({
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
@endsection