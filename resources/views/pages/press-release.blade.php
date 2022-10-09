@extends('adminlte::page')

@section('title', 'Press Release')

@section('content_header')
    <h1>Press Release</h1>
@stop
{{-- @section('plugins.Datatables', true) --}}

@section('content')
    @php
        $data = [];
        $heads = ['Id', 'Title', 'Description', ['label' => 'Created At', 'width' => 10], ['label' => 'Updated At', 'width' => 10], ['label' => 'Action', 'width' => 10]];
        function gen($id)
        {
            $btnUpdate = '<a href=' . url('press-release/update') . '/' . $id . ' class="btn-update btn btn-success btn-xs " title="Details"><i class="fa fa-lg fa-fw fa-pen"></i></a>';
            $btnDelete = '<a href=' . url('press-release/delete') . '/' . $id . ' class="btn-delete btn btn-xs btn-default text-danger mx-1 shadow" title="Delete"><i class="fa fa-lg fa-fw fa-trash"></i></a>';
        
            return '<span>' . $btnUpdate . $btnDelete . '</span>';
        }
        foreach ($press_releases as $value) {
            $data[] = [$value->id, $value->title, $value->description, $value->created_at, $value->updated_at, gen($value->id)];
        }
        $config = [
            'data' => $data,
            'order' => [[2, 'asc']],
            'columns' => [['visible' => false], null, null, null, null, ['orderable' => false]],
            'destroy' => true,
        ];
    @endphp
    <x-adminlte-card title="Press Release Information" theme="primary">
        @if (session('failed'))
            <div class="alert alert-danger">
                {{ session('failed') }}
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ url('/press-release/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Press Release</a>


        <x-adminlte-datatable withFooter id="users" :heads="$heads" :config="$config" bordered hoverable striped
            with-buttons>
            @foreach ($config['data'] as $row)
                <tr>
                    @foreach ($row as $cell)
                        <td>{!! $cell !!}</td>
                    @endforeach
                </tr>
            @endforeach

        </x-adminlte-datatable>

    </x-adminlte-card>
@stop

@section('css')

@stop

@section('js')
    <script>
        $(document).ready(function() {


        });
    </script>
@stop
