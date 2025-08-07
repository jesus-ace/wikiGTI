@extends('pagina.layout')

@section('title', 'WikiGTI')


@section('sidebar')
    @extends('pagina.components.navbar')
@endsection


@section('content')

<section class="section-soporte mt-5" id="soporte">
    <div class="container">
        <div class="titulo">
            <h1>Division de Soporte</h1>
        </div>
        <div class="row">
            <div class="info-soporte owl-carousel owl-theme">
                @isset($soporte)
                    @foreach ($soporte as $soporte_item)
                    <div class="item">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{$soporte_item->titulo}}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{$soporte_item->nombre}} {{$soporte_item->apellido}}</h6>
                                <div class="card-text" style="overflow: hidden; height: 254px;">
                                    @php
                                    echo $soporte_item->description;
                                    @endphp
                                </div>
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div>
                          </div>
                    </div>
                    @endforeach
                @endisset


            </div>
        </div>
    </div>

</section>



<section class="section-redes mt-5" id="redes">
    <div class="container">
        <div class="titulo">
            <h1>Division de Redes</h1>
        </div>
        <div class="row">
            <div class="info-redes owl-carousel owl-theme">
                @isset($redes)
                    @foreach ($redes as $redes_item)
                    <div class="item">
                        <div class="card card-index" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{$redes_item->titulo}}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{$redes_item->nombre}} {{$redes_item->apellido}}</h6>
                                <div class="card-text" style="overflow: hidden; height: 254px;"> @php
                                    echo $redes_item->description;
                                @endphp
                                </div>
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div>
                          </div>
                    </div>
                    @endforeach
                @endisset


            </div>
        </div>
    </div>

</section>



<section class="section-desarrollo mt-5" id="desarrollo">
    <div class="container">
        <div class="titulo">
            <h1>Division de Desarrollo</h1>
        </div>
        <div class="row">
            <div class="info-desarrollo owl-carousel owl-theme">
                @isset($desarrollo)
                    @foreach ($desarrollo as $desarrollo_item)
                    <div class="item">
                        <div class="card" style="width: 18rem;">
                            <div class="card-body">
                                <h5 class="card-title">{{$desarrollo_item->titulo}}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{$desarrollo_item->nombre}} {{$desarrollo_item->apellido}}</h6>
                                <div class="card-text" style="overflow: hidden; height: 254px;">
                                    @php
                                        echo $desarrollo_item->description
                                    @endphp
                                </div>
                                <a href="#" class="card-link">Card link</a>
                                <a href="#" class="card-link">Another link</a>
                            </div>
                          </div>
                    </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>

</section>

@endsection


@section('js')
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/paginaweb/js/owl-carousel.js"></script>
    <script src="/paginaweb/js/app.js"></script>
@endsection

