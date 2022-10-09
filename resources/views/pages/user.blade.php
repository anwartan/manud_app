@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop
{{-- @section('plugins.Datatables', true) --}}

@section('content')
    @php
        $data = [];
        $heads = ['Id', 'Name', 'Email', ['label' => 'Created At', 'width' => 10], ['label' => 'Updated At', 'width' => 10], ['label' => 'Action', 'width' => 10]];
        function gen($id)
        {
            $btnUpdate = '<a href=' . url('admin/user/update') . '/' . $id . ' class="btn-update btn btn-success btn-xs " title="Details"><i class="fa fa-lg fa-fw fa-pen"></i></a>';
            $btnDelete = '<a href=' . url('admin/user/delete') . '/' . $id . ' class="btn-delete btn btn-xs btn-default text-danger mx-1 shadow" title="Delete"><i class="fa fa-lg fa-fw fa-trash"></i></a>';
        
            return '<span>' . $btnUpdate . $btnDelete . '</span>';
        }
        foreach ($users as $value) {
            $data[] = [$value->id, $value->name, $value->email, $value->created_at, $value->updated_at, gen($value->id)];
        }
        $config = [
            'data' => $data,
            'order' => [[2, 'asc']],
            'columns' => [['visible' => false], null, null, null, null, ['orderable' => false]],
            'destroy' => true,
        ];
    @endphp
    <x-adminlte-card title="User Information" theme="primary">
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

        <a href="{{ url('/admin/user/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add User</a>


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
