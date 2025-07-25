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
    ['label' => 'Divison', 'width' => 40],
    ['label' => 'Manual', 'width' => 40],
    ['label' => 'Actions', 'no-export' => true, 'width' => 5],
];

$btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                <i class="fa fa-lg fa-fw fa-pen"></i>
            </button>';
$btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                  <i class="fa fa-lg fa-fw fa-trash"></i>
              </button>';
$btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button>';

$config = [
    'data' => $data,
    'order' => [[1, 'asc']],
    'columns' => [null, null, null, ['orderable' => false]]
];


@endphp

<x-adminlte-datatable id="table1" :heads="$heads" :config="$config" theme="light"   striped hoverable with-buttons>
    @foreach($config['data'] as $row)
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
                <button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                   <i class="fa fa-lg fa-fw fa-eye"></i>
               </button></nobr></td>
        </tr>
    @endforeach
</x-adminlte-datatable>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
@stop