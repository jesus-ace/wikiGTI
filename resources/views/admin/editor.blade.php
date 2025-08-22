<!DOCTYPE html>
@extends('adminlte::page')
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@section('title', 'Dashboard')

@section('content_header')
    <h1>Editor de contenido</h1>
    <div id="allert-success" class="alert alert-success alert-dismissible d-none">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <h5><i class="icon fas fa-check"></i>¡Operación exitosa!</h5>
        Los cambios se guardaron correctamente.
    </div>
@stop

@section('content')


<div class="card card-outline card-primary">
    <!-- /.card-header -->
    <div class="card-body">
       <form action="">
            <div class="row">
                <div class="col">
                    <label class="form-label">Titulo</label>
                    <input type="text" id="titulo" class="form-control"  aria-label="titulo" value="">
                </div>
                <div class="col">
                    <label  class="form-label">División</label>
                    <select class="form-control" id="division" id="exampleFormControlSelect1">
                        @foreach ($division as $item)
                            <option value="{{$item->id}}">{{$item->division}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <textarea name="contenido" id="editor"></textarea>
                </div>

            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-success mt-5" id="seve_content">Guardar</button>
            </div>
        </form>
    </div>

  </div>


@stop

@section('css')
    <link rel="stylesheet" href=" {{asset('vendor/bootstrap/js/bootstrap.min.js')}}">
@stop

@section('js')
<script src="{{asset('vendor/tinymce/tinymce.min.js')}}"></script>

<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>

<script>
    tinymce.init({
        selector: '#editor',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>
<script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
<script>
    let data = @php echo $contenido @endphp;
    data.forEach(element => {
        $('#titulo').val(element.titulo);
        $('#division').val(element.division_id);
        $('#editor').val(element.description);

        const id_content = element.id;
    });

    $(document).ready(function() {
        $('#seve_content').click(function() {
            $.ajax({
                url : '{{ route('updateContenido') }}',
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
                data: {
                    'id': data[0].id,
                    'titulo': $('#titulo').val(),
                    'division_id': $('#division').val(),
                    'contenido':  tinymce.get('editor').getContent()
                },
                success:  function(r){
                    if(r.success == true){
                        $('#allert-success').removeClass('d-none');
                        $('#allert-success').addClass('d-block');
                    }
                }
            });
        });
    });




</script>

@stop
