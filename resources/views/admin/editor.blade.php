@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editor de contenido</h1>
    <div  id="allert-success" class="alert alert-success alert-dismissible d-none">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        Success alert preview. This alert is dismissable.
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
                    <textarea name="contenido" id="contenido" cols="30" rows="10"></textarea>
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
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/vendor/bootstrap/js/bootstrap.min.js">
@stop

@section('js')
<script src="/vendor/ckeditor/ckeditor.js"></script>
<script src="/vendor/jquery/jquery.min.js"></script>
<script>
    let data = @php echo $contenido @endphp;
    data.forEach(element => {
        $('#titulo').val(element.titulo);
        $('#division').val(element.division_id);
        $('#contenido').val(element.description);

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
                    'contenido':  CKEDITOR.instances.contenido.getData(),
                },
                success:  function(r){
                    if(r === true){
                        $('#allert-success').removeClass('d-none');
                        $('#allert-success').addClass('d-block');
                    }
                }
            });
        });
    });




</script>
<script>
    CKEDITOR.replace('contenido');
</script>
@stop
