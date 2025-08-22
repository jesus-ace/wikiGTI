<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('paginaweb/css/style.css ') }}">
    <link rel="stylesheet" href="{{ asset('paginaweb/css/owl-carousel.css') }}">
    <link rel="icon" href="{{asset('favicons/favicon.ico')}}" type="image/x-icon">
    @yield('css')
    <title> @yield('title')</title>
  </head>
  <body>

    {{-- @extends('pagina.components.navbar') --}}

    {{-- CONTENIDO --}}

    @section('sidebar')
    @show

    <div class="container">
        @yield('content')
    </div>


    <div class="footer">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-3 d-flex flex-column align-self-center align-items-center" style="margin-top: 25px">
                    <img src="/paginaweb/image/covetelOld.png" alt="" class="col-lg-5 img-responsive">
                    <img src="/paginaweb/image/vive.png" alt="" class="col-lg-5 img-responsive">
                </div>
                <div class="col-1 espaciador"></div>
                <div class="col-3" style="margin-top: 44px;">VICEPRESIDENCIA DE GESTIÓN PARA EL DESAROLLO TECNOLOGICO</div>
                <div class="col-1 espaciador"></div>
                <div class="col-3" style="margin-top: 55px;">GERENCIA TECNOLOGIA DE LA INFORMACIÓN</div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    @yield('js')

  </body>
</html>