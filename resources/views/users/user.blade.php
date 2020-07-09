@extends('layouts.app_personalized')
@section('content')
<?php $user=\Auth::user() ?>
<div class="container mt-5 align-content-center">
<div class="card mb-3">
  <div class="row no-gutters">
    <div class="col-md-4">
      <img src="
      <?php if(!empty($user->image)){
          echo asset('profiles/'.$user->image);
      }else{
           echo asset('profiles/generic.png');
      }?>
      " class="card-img img-fluid">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <p class="card-text">Nombre: {{$user->name}}</p>
        <p class="card-text">Telefono: {{$user->phone}}</p>
        <p class="card-text">Edad: {{$user->age}}</p>
        <p class="card-text">Email: {{$user->email}}</p>
        <p class="card-text"><small class="text-muted">ultima vez editado {{$user->updated_at}}</small></p>
        
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseFamily" aria-expanded="false" aria-controls="collapseFamily">
          Familia
        </button>
        <button id='edit_user' class="btn btn-danger">Editar</button>
     
      </div>
    </div>
    <div class="col-md-12 collapse" id="collapseFamily">
        <div class="card card-body">
          
        </div>
    </div>
  </div>
</div>
</div>
<div id="modalEdituser" class="modal" tabindex="-1" role="dialog">
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

@endsection
@section('script')
<script src="{{asset('js/jquery.validate.min.js')}}"></script>
<script src="{{asset('/js/bootbox.all.min.js')}}"></script>
<script>
  $('#edit_user').on('click',()=>{
    let link='{{url("usuario")}}/{{$user->id}}/edit'
    $.ajax({
          url: link,
          type: 'GET',
          success: function(data) {
              $('#modalEdituser .modal-body').html(data.html)
              $('#modalEdituser').modal('show')
          },
          error: function() {
              bootbox.alert("Ah ocurrido un error, intentelo despues")
              console.log("error al editar usuario")
          }
      });
 })

const getCollapseFamily=()=>{
  let link='{{url("usuario/familia")}}/{{$user->id}}'
  $.ajax({
          url: link,
          type: 'GET',
          success: function(data) {
              $('#collapseFamily .card-body').html(data.html)
          },
          error: function() {
              bootbox.alert("Ah ocurrido un error, intentelo despues")
              console.log("error al editar usuario")
          }
   });
}

$(document).ready(function () {
  getCollapseFamily();
});
</script>
@endsection