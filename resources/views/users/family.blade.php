<div class="container">
	<div class="row align-content-center">
		@foreach ($family_1 as $fam)
		<div class="card col-md-4 ml-3" style="width: 18rem;">
			<img src='{{asset("profiles/$fam->image")}}'' class="img-fluid card-img" alt="..." >
			<div class="card-body">
			  <h5 class="card-title">{{$fam->name}}</h5>
			  <p class="card-text">{{$fam->description}}</p>
			  @if(!$fam->creation)
			  <div class="row">
			    <a href="#" id="{{$fam->vertex_2}}"  class="edit_user_family btn btn-primary">Editar</a>
			    <a href="#" id="{{$fam->vertex_2}}"  class="delete_user_family btn btn-danger ml-2">Eliminar</a>
			  </div>
			  @endif
			</div>
		</div>
		@endforeach
		@foreach ($family_2 as $fam)
		<div class="card col-md-4 ml-3" style="width: 18rem;">
			<img src='{{asset("$fam->image")}}'' class="card-img-top" alt="...">
			<div class="card-body">
			  <h5 class="card-title">{{$fam->name}}</h5>
			  <p class="card-text">{{$fam->description}}</p>
			  @if(!$fam->creation)
			  <a href="#" id="{{$fam->vertex_1}}"  class="edit_user_family btn btn-primary">Editar</a>
			  <a href="#" id="{{$fam->vertex_1}}"  class="delete_user_family btn btn-danger ml-2">Eliminar</a>
			  @endif
			</div>
		</div>
		@endforeach
	</div>
	<div class="row align-content-center mt-3">
		<button id="add-family" data-user="{{$user_principal}}" class="btn btn-primary">Agregar nuevo</button>
	</div>
</div>

<div id="modalEdituserFam" class="modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
	  <div class="modal-content">
		<div class="modal-header">
		  <h5 class="modal-title">Editar usuario</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
  
		</div>
		<div class="modal-footer">
		  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		</div>
	  </div>
	</div>
</div>

<script>
 $('[class*="edit_user_family"]').click((event)=>{
    let link=`{{url("usuario")}}/${$(event.target).attr('id')}/edit`
    $.ajax({
          url: link,
          type: 'GET',
          success: function(data) {
			  $('#modalEdituserFam .modal-title').text('Editar usuario')
              $('#modalEdituserFam .modal-body').html(data.html)
              $('#modalEdituserFam').modal('show')
          },
          error: function() {
              bootbox.alert("Ah ocurrido un error, intentelo despues")
              console.log("error al editar usuario")
          }
      });
 })
 $('[class*="delete_user_family"]').on('click',(event)=>{
    let link=`{{url("/usuario/delete/")}}/${$(event.target).attr('id')}`
    $.ajax({
          url: link,
		  type: 'POST',
		  headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(data) {
			  bootbox.alert("Usuario eliminado correctamente!")
			  location.reload()
          },
          error: function() {
              bootbox.alert("Ah ocurrido un error, intentelo despues")
              console.log("error al eliminar usuario")
          }
      });
 })
 $('#add-family').on('click',(event)=>{
    let link=`{{url("/usuario/familia/agregar/")}}/${$('#add-family').data('user')}`
    $.ajax({
          url: link,
          type: 'GET',
          success: function(data) {
			  $('#modalEdituserFam .modal-title').text('Agregar familiar')
              $('#modalEdituserFam .modal-body').html(data.html)
              $('#modalEdituserFam').modal('show')
          },
          error: function() {
              bootbox.alert("Ah ocurrido un error, intentelo despues")
              console.log("error al editar usuario")
          }
      });
 }) 

</script>