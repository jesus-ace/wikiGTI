@extends('adminlte::page')
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
    'Cedula',
    'Username',
    'Email',
    'Divison',
    'Rol',
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
                 <a href="{{ route('userRegister') }}" style="color:#ffff !important"> Registrar Usuario <i class="fas fa-fw fa-plus"></i> </a>
            </button>
        </div>
    </div>

    <div class="card-body">
        <x-adminlte-datatable id="table1" :heads="$heads" :config="$config" theme="light" striped hoverable with-buttons>
            @foreach($data as $row)
                <tr>
                    <td>{{$row['id']}}</td>
                    <td>{{$row['nombre']}} {{$row['apellido']}}</td>
                    <td>{{$row['celdula']}}</td>
                    <td>{{$row['username']}}</td> 
                    <td>{{$row['email']}}</td> 
                    <td>{{$row['division']}}</td>
                    <td>{{$row['rol']}}</td>
                    <td><nobr>
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                           <a class="fa fa-lg fa-fw fa-pen" href="/admin/usuarios/editar/{{$row['cedula']}}"></a>
                        </button>
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                        </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
</div>


@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="{{asset('vendor/datatables/css/dataTables.bootstrap4.min.css')}}">
@stop

@section('js')
    <script src="{{asset('vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
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
