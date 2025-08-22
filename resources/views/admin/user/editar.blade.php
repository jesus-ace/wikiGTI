@extends('adminlte::page')

@section('title', 'Dashboard')

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

@stop

@section('content')


<div class="card card-outline card-primary">
    <!-- /.card-header -->
    <div class="card-body">
       <form action="">
            <div class="row">
                <div class="col">
                    <label class="form-label">Cedula</label>
                    <input type="text" id="cedula" class="form-control"  aria-label="cedula" value="{{$data->cedula}}" disabled>
                </div>
                <div class="col">
                    <label class="form-label">Nombre</label>
                    <input type="text" id="nombre" class="form-control"  aria-label="nombre" value="{{$data->nombre}}">
                </div>
                <div class="col">
                    <label class="form-label">Apellido</label>
                    <input type="text" id="apellido" class="form-control"  aria-label="apellido" value="{{$data->apellido}}">
                </div>
            </div>
            <div class="row mt-5">
                 <div class="col">
                    <label class="form-label">Username</label>
                    <input type="text" id="username" class="form-control"  aria-label="username" value="{{$data->username}}">
                </div>
                 <div class="col">
                    <label class="form-label">Correo</label>
                    <input type="text" id="correo" class="form-control"  aria-label="correo" value="{{$data->email}}">
                </div>

                <div class="col">
                    <label class="form-label">Password</label>
                    <input type="password" id="password" class="form-control"  aria-label="password" value="{{$data->password}}">
                </div>

            </div>
            <div class="row mt-5">
                <div class="col">
                    <label  class="form-label">División</label>
                    <select class="form-control" id="division" id="exampleFormControlSelect1" value="{{$data->division_id}}>
                        @foreach ($division as $item)
                            <option value="{{$item->id}}">{{$item->division}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label  class="form-label">Rol</label>
                    <select class="form-control" id="rol" id="exampleFormControlSelect1" value="{{$data->rol_id}}>
                        @foreach ($rol as $item_rol)
                            <option value="{{$item_rol->id}}">{{$item_rol->rol}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-success mt-5" id="save_form_user">Guardar</button>
            </div>
        </form>
    </div>

  </div>


@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/js/bootstrap.min.js')}}">
@stop

@section('js')

<script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>

<script>
$("#save_form_user").on("click",function(){
	$.ajax({
		type : "POST",
		url : "{{ route('updateUser') }}",
		data : {
			"cedula": $('#cedula').val(),	
            "nombre":$('#nombre').val(),
			"apellido":$('#apellido').val(),
			"username":$('#username').val(),
            "email":$('#correo').val(),
            "password":$('#password').val(),
            "division_id":$('#division').val(),
            "rol_id":$('#rol').val()
                    
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
			clearInput();
        }
		$('#user_save').addClass('show');
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