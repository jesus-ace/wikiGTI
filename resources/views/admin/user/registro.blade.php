@extends('adminlte::page')

@section('title', 'Dashboard')
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@section('content_header')
    <h1>Registrar Usuario</h1>


     <div id="toastsContainerTopRight" class="toasts-top-right fixed">
        <div class="toast bg-success fade" id='user_save' role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="mr-auto">¡Operación exitosa!</strong>
                <button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="toast-body">Los cambios se guardaron correctamente.</div>
        </div>
    </div>


    <div id="toastsContainerTopRight" class="toasts-top-right fixed">
        <div class="toast bg-info fade" id='user_exit' role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="mr-auto">USUARIO REGISTRADO</strong>
                <button data-dismiss="toast" type="button" class="ml-2 mb-1 close" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="toast-body">Este usuario ya se encuentra registrado</div>
        </div>
    </div>
@stop

@section('content')


<div class="card card-outline card-primary">
    <!-- /.card-header -->
    <div class="card-body">
       <form action="">
            <div class="row">
                <div class="col">
                    <label class="form-label">Cedula</label>
                    <input type="text" id="cedula" class="form-control"  aria-label="cedula" value="">
                </div>
                <div class="col">
                    <label class="form-label">Nombre</label>
                    <input type="text" id="nombre" class="form-control"  aria-label="nombre" value="" disabled>
                </div>
                <div class="col">
                    <label class="form-label">Apellido</label>
                    <input type="text" id="apellido" class="form-control"  aria-label="apellido" value="" disabled>
                </div>
            </div>
            <div class="row mt-5">
                 <div class="col">
                    <label class="form-label">Username</label>
                    <input type="text" id="username" class="form-control"  aria-label="username" value="" disabled>
                </div>
                 <div class="col">
                    <label class="form-label">Correo</label>
                    <input type="text" id="correo" class="form-control"  aria-label="correo" value="" disabled>
                </div>

                <div class="col">
                    <label class="form-label">Password</label>
                    <input type="text" id="password" class="form-control"  aria-label="password" value="" disabled >
                </div>

            </div>
            <div class="row mt-5">
                <div class="col">
                    <label  class="form-label">División</label>
                    <select class="form-control" id="division" id="exampleFormControlSelect1">
                        @foreach ($division as $item)
                            <option value="{{$item->id}}">{{$item->division}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label  class="form-label">Rol</label>
                    <select class="form-control" id="rol" id="exampleFormControlSelect1">
                        @foreach ($rol as $item_rol)
                            <option value="{{$item_rol->id}}">{{$item_rol->rol}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-success mt-5" id="save_form_user" disabled>Guardar</button>
            </div>
        </form>
    </div>

  </div>


@stop

@section('css')
    <link rel="stylesheet" href="/vendor/bootstrap/js/bootstrap.min.js">
@stop

@section('js')

<script src="/vendor/jquery/jquery.min.js"></script>


<script>
	$("#cedula").on("change",function(){
	$.ajax({
		type : "POST",
		url : "{{ route('buscarLDAP') }}",
		data : {"cedula":this.value},
		cache : false,
		async:true,
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
		statusCode : {
			404 : function(){
				alert("link roto")
			}
		}
	}).done(function(resp){
		let data = JSON.parse(resp);
		if (data.status == false) {
				//alert(data.msj);
			$('#user_exit').addClass('show');
		}else{
			$('#nombre').val(data.nombre);
			$('#apellido').val(data.apellido);
            $('#correo').val(data.login+"@vive.gob.ve");
			$('#username').val(data.login);
            $('#password').val(data.password);

			$("#save_form_user").removeAttr('disabled');

		}
			

	});
});

$("#save_form_user").on("click",function(){
	$.ajax({
		type : "POST",
		url : "{{ route('registroUser') }}",
		data : {
					"cedula":$('#cedula').val(),
					"nombre":$('#nombre').val(),
					"apellido":$('#apellido').val(),
					"username":$('#username').val(),
                    "correo":$('#correo').val(),
                    "password":$('#password').val(),
                    "division":$('#division').val(),
                    "rol":$('#rol').val(),
                    
				},
		cache : false,
		async:true,
        headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
		statusCode : {
			404 : function(){
				alert("link roto")
			}
		}
	}).done(function(resp){
        console.log(resp);
		let data = JSON.parse(resp);
		if (data.status == false) {
			Swal.fire({
				title: 'Existente',
				text: data.msj,
				icon: 'info',
				confirmButtonText: 'Ok'
			})
			clearInput();
		}else{
			Swal.fire({
				title: 'Se guardo correctamente',
				text: data.msj,
				icon: 'success',
				confirmButtonText: 'Ok'
			})
			clearInput();
		}
	})
});

function clearInput(){
	$('#cedula').val("");
	$('#nombre"').val("");
	$('#apellido').val("");
	$('#username').val("");
    $('#correo').val("");
    $('#password').val("");
    $('#division').val("");
    $('#rol').val("");
}

</script>

@stop
)