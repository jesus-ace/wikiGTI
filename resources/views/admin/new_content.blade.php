@extends('adminlte::page')

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
                    {{-- <div id="editor">
                        <p>Hello from CKEditor 5!</p>
                    </div> --}}
                    <textarea name="editor" id="editor" ></textarea>
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
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="/vendor/bootstrap/js/bootstrap.min.js">
    <link rel="stylesheet" href="">
@stop

@section('js')

<script src=""></script>

<script src="/vendor/jquery/jquery.min.js"></script>

<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
    });
</script>



{{-- <script>
    const {
        ClassicEditor,
        Essentials,
        Paragraph,
        Bold,
        Italic,
        Font
    } = CKEDITOR;
    // Create a free account and get <YOUR_LICENSE_KEY>
    // https://portal.ckeditor.com/checkout?plan=free
    ClassicEditor
        .create( document.querySelector( '#editor' ), {
            licenseKey: '<YOUR_LICENSE_KEY>',
            plugins: [ Essentials, Paragraph, Bold, Italic, Font ],
            toolbar: [
                'undo', 'redo', '|', 'bold', 'italic', '|',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
            ]
        } )
        .then( editor => {
            window.editor = editor;
        } )
        .catch( error => {
            console.error( error );
        } );
</script> --}}

<script>
    $(document).ready(function() {
        $('#seve_content').click(function() {
            $.ajax({
                url : '{{ route('createContenido') }}',
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Accept': 'application/json'
                },
                data: {
                    'titulo': $('#titulo').val(),
                    'division_id': $('#division').val(),
                    'contenido':  CKEDITOR.instances.contenido.getData(),
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
