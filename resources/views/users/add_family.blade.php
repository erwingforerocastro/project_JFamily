<div class="container">
    <div class="row">
        <form id="form_add_family"  onsubmit="event.preventDefault();" class="row">
               <div class="col-md-12">
                  <label class="col-form-label">Identificación</label>
                  <input type="text" name="identification" id="identification_user" class="form-control" placeholder="CC NIT etc..">
                </div>
                <div class="col-md-7">
                    <label class="col-form-label">Nombre</label>
                    <input type="text" name="name" id="name_user" class="form-control" placeholder="Usuario">
                </div>
                <div class="col-md-5">
                    <label class="col-form-label" >Edad</label>
                    <input type="number" name="age" id="age_user" class="form-control" placeholder="00">
                </div>
                <div class="col-md-12">
                    <label class="col-form-label" >Ocupación</label>
                    <input type="text" name="ocupation" id="ocupation_user" class="form-control" placeholder="Ejem: Medico">
                </div>
                <div class="col-md-6">
                    <label class="col-form-label" >Consanginidad:</label>
                    <select name="consanguinity" class="form-control" id="consanguinity_user"></select>
                </div>
                <div class="col-md-6">
                    <label class="col-form-label" >Parentesco:</label>
                    <input type="text" name="relationship" id="relationship_user" class="form-control" placeholder="Ejem: Hermano"></input>
                </div>
                <div class="col-md-12 row justify-content-center mt-3">
                    <button class="btn btn-danger" type="submit">Guardar</button>
                </div>
        </form>
    </div>
</div>
<script>
        const consanguinity=['Nivel 1','Nivel 2','Nivel 3']

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
                    }
                     
                }else{
                    $('input').attr('disabled', false);
                    $('button[type="submit"]').show()
                }
            }
        });
    });
    $('#form_add_family').validate({
        submitHandler: function(form) {
                let html = "<p class='text-center mx-auto'>¿Seguro que quiere guardar este nuevo familiar?</p>"
                bootbox.confirm({
                    message: html,
                    buttons: {
                        confirm: {
                            label: 'Si',
                            className: 'btn-outline-success'
                        },
                        cancel: {
                            label: 'No',
                            className: 'btn-outline-danger'
                        }
                    },
                    callback: function(result) {
                        if (result) {
                            let link='{{url("/usuario/familia/guardar/")}}/{{$id}}'
                            $.ajax({
                                url: link,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                type: 'POST',
                                data: $('#form_add_family').serialize() ,
                                success: function(data) {
                                    console.log(data)
                                    $('#modalEdituserFam').modal('hide');
                                    bootbox.alert("información guardada");
                                    location.reload();
                                },
                                error: function() {
                                    bootbox.alert("Ah ocurrido un error, intentelo despues");
                                    $('#modalEdituserFam').modal('hide');
                                }
                            });
                        }
                    }
                });
            return false;
        },
        rules: {
            identification: {
                required: true,
                number:true
            },
            name: {
                required: true,
            },
            age: {
                required: true,
                number:true,
                min: 1,
            },
            consanguinity: {
                required: true,
            },
            relationship: {
                required: true,
            },
        },
        messages: {
            name: {
                required: "El nombre del usuario es requerido"
            },
            identification:{
                required:"La identificacion es requerida",
                number:'La identificacion debe ser un numero'
            },
            age: {
                required: "La edad es requerida",
            },
            consanguinity:{
                required:"El nivel de consanguinidad es requerido",
            },
            relationship: {
                required:"La relación con la persona es requerido",
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

    const loadConsanguinity=()=>{
        let html=''
        consanguinity.map(v=>html+=`<option value='${v}'>${v}<option/>`)
        $('#consanguinity_user').html(html)
    } 

    $(document).ready(function () {
        loadConsanguinity();
    });
</script>