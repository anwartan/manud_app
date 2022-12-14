@extends('adminlte::page')

@section('title', 'Budget')

@section('content_header')
    <h1>Budget</h1>
@stop
{{-- @section('plugins.Datatables', true) --}}
@section('plugins.Sweetalert2', true)

@section('content')
    @php
        $data = [];
        $heads = ['Id', 'Budget Date', 'Title', 'Description', ['label' => 'Created At', 'width' => 10], ['label' => 'Updated At', 'width' => 10], ['label' => 'Action', 'width' => 10]];
        function gen($id)
        {
            $btnUpdate = '<a href=' . url('budget/') . '/' . $id . '/edit' . ' class="btn-update btn btn-success btn-xs " title="Details"><i class="fa fa-lg fa-fw fa-pen"></i></a>';
            $btnDelete = '<a href="javascript:void(0)" data-id=' . $id . ' class="btn-delete btn btn-xs btn-default text-danger mx-1 shadow" title="Delete"><i class="fa fa-lg fa-fw fa-trash"></i></a>';
        
            return '<span>' . $btnUpdate . $btnDelete . '</span>';
        }
        foreach ($budgets as $value) {
            $data[] = [$value->id, $value->budget_date, $value->title, $value->description, $value->created_at, $value->updated_at, gen($value->id)];
        }
        $config = [
            'data' => $data,
            'order' => [[2, 'asc']],
            'columns' => [['visible' => false], null, null, null, null, null, ['orderable' => false]],
            'destroy' => true,
        ];
    @endphp
    <x-adminlte-card title="Budget Information" theme="primary">
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

        <a href="{{ url('/budget/create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add Budget</a>


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

            $('.btn-delete').click(function() {
                var id = $(this).attr('data-id')
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {

                    if (result.value) {
                        window.location.href = "{!! url('/budget/delete') !!}" + "/" + id

                    }
                })
            });
        });
    </script>
@stop
