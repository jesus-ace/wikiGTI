@extends('pagina.layout')

@section('title', 'WikiGTI')


@section('sidebar')
    @extends('pagina.components.navbar')
@endsection


@section('content')
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="breadcrumbs">
            <ol>
                <li>
                    <a><span>Inicio</span></a>
                    <meta itemprop="position" content="1">
                </li><i class="breadcrumb-spacer icon-arrow-right"></i>
                <li>
                    <a>
                        <span itemprop="name">{{$contenido->division}}</span>
                    </a><meta itemprop="position" content="2"></li>
                    <i class="breadcrumb-spacer icon-arrow-right"></i>
                <li>
                    <span itemprop="name" class="current">{{$contenido->titulo}}</span>
                    <meta itemprop="position" content="3">
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-2">
            <div class="left-column">
                <div id="section-menu" class="list-group">
                    @foreach ($manuales as $manual)
                        @if ($manual->id === $contenido->id)
                            <div class="list-group-item nav-header list-group-item-first hidden-lg active-hover">
                                <a href="{{ route('mostrarmanual', ['division' => $manual->division, 'manual' => $manual->titulo]) }}" class="list-group-item-link">{{$manual->titulo}}</a>

                                <span href="#menu2" data-toggle="collapse" data-parent="#section-menu" class="nav-link-container visible-xs-block">
                                    <i class="nav-link ion-chevron-up">
                                    </i>
                                    <i class="nav-link ion-chevron-down">
                                    </i>
                                </span>
                            </div>
                        @else
                            <div class="list-group-item nav-header list-group-item-first hidden-lg">
                                <a href="{{ route('mostrarmanual', ['division' => $manual->division, 'manual' => $manual->titulo]) }}" class="list-group-item-link">{{$manual->titulo}}</a>

                                <span href="#menu2" data-toggle="collapse" data-parent="#section-menu" class="nav-link-container visible-xs-block">
                                    <i class="nav-link ion-chevron-up">
                                    </i>
                                    <i class="nav-link ion-chevron-down">
                                    </i>
                                </span>
                            </div>
                        @endif



                    @endforeach


                </div>
            </div>
        </div>

        {{-- contenido --}}

        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
			<div class="panel panel-default panel-wide">
				<div class="panel-heading panel-heading-alt hidden-xs">
					<span>{{$contenido->titulo}}</span>
				</div>
				<div class="panel-body">
                    @php
                        echo $contenido->description
                    @endphp
				</div>
            </div>
		</div>
        {{-- fin contenido --}}

        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="hidden-xs right-column">
                <div class="panel panel-primary nuevo-panel">
                    <div class="accesos-principal">
                        <span id="reservahorah2">AUTOR</span>
                        <div >
                            <div class="img-autor"><img src="/paginaweb/image/27647120.jpg" alt=""></div>
                            <div class="nom-autor"><span>{{$contenido->nombre}} {{$contenido->apellido}}</span></div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-primary nuevo-panel">
                    <div class="accesos-principal">
                        <span id="reservahorah2"> MANUALES </span>
                        
                        <a href="" class="btn btn-primary btn-lg btn-block">Soporte</a>
                        <a href="" class="btn btn-primary btn-lg btn-block">Redes</a>
                        <a href="" class="btn btn-primary btn-lg btn-block">Desarrollo</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

