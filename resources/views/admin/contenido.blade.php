@extends('adminlte::page')
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@section('title', 'Dashboard')
@section('content_header')
    <h1>Contenido</h1>
@stop

@section('content')
    {{-- Setup data for datatables --}}
@php
$heads = [
    'ID',
    'Autor',
    ['label' => 'Divison', 'width' => 40],
    ['label' => 'Manual', 'width' => 40],
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];


$config = [
    'order' => [[0, 'asc']],
    'order' => [[1, 'asc']],
    'language' => [
        'url' => '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
    ]
];


@endphp
<div class="card card-outline card-primary">
    <div class="card-header">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-success">
                 <a href="{{ route('newContent') }}" style="color:#ffff !important"> AGREGAR <i class="fas fa-fw fa-plus"></i> </a>
            </button>
        </div>
    </div>

    <div class="card-body">
        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" theme="light" striped hoverable with-buttons>
            @foreach($data as $row)
                <tr>
                    <td>{{$row['id']}}</td>
                    <td>{{$row['nombre']}} {{$row['apellido']}}</td>
                    <td>{{$row['division']}}</td>
                    <td>{{$row['titulo']}}</td>
                    <td><nobr>
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                           <a class="fa fa-lg fa-fw fa-pen" href="/admin/contenido/editor/{{$row['id']}}"></a>
                        </button>
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
</div>


@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/css/dataTables.bootstrap4.min.css')}}">
@stop

@section('js')
    <script src="{{ asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js')}}"></script>
    <script src="https://cdn.ckeditor.com/4.24.0-lts/standard/ckeditor.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize DataTables with proper error handling
            try {
                $('#table1').DataTable();
            } catch (e) {
                console.error('DataTable initialization error:', e);
            }
        });
    </script>
@stop
