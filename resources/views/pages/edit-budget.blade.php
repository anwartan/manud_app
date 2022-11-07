@extends('adminlte::page')

@section('title', 'Activity')

@section('content_header')
    <h1>Update Budget</h1>
@stop
{{-- @section('plugins.Datatables', true) --}}
@section('plugins.bs-custom-file-input', true)
@section('plugins.Date Range Picker', true)

@section('content')
    <div class="row">

        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Budget Information</h3>
                </div>


                <form enctype="multipart/form-data" action="{{ url('budget') }}{{ '/' . $budget->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">
                        <div class="form-group">
                            <label for="budget_date">Budget Date:</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" name="budget_date" class="form-control float-right" id="budget_date"
                                    value="{{ $budget->getBudgetDateString() }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title"
                                class="form-control @error('title')
                            is-invalid
                            @enderror"
                                id="title" placeholder="Enter name" value="{{ $budget->title }}">
                            @error('title')
                                <span id="title-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5"
                                placeholder="Enter Description">{{ $budget->description }}</textarea>

                            @error('description')
                                <span id="description-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="attachments">Attachments</label>
                            <x-adminlte-input-file multiple name="attachments[]" id="attachments"
                                placeholder="Choose Attachments">
                            </x-adminlte-input-file>
                        </div>
                        @php
                            $arrayAttachments = explode(';', $budget->attachments);
                        @endphp
                        <ul class="list-unstyled">
                            @foreach ($arrayAttachments as $key => $item)
                                @php
                                    $ext = strtolower(pathinfo($item, PATHINFO_EXTENSION));
                                    
                                    $icon = 'fa-file';
                                    if ($ext == 'pdf') {
                                        $icon = 'fa-file-pdf';
                                    } elseif ($ext == 'word') {
                                        $icon = 'fa-file-word';
                                    } elseif (in_array($ext, ['jpeg', 'jpg', 'png'])) {
                                        $icon = 'fa-file-image';
                                    }
                                @endphp
                                @if (!empty($item))
                                    <li class="list-attachment">
                                        <input type="hidden" name="old_attachments[{{ $key }}]"
                                            value="{{ $item }}" />
                                        <a target="_blank" href="{{ URL::to('/') . '/files/' . $item }}"
                                            class="btn-link text-secondary"><i class="far fa-fw {{ $icon }}"></i>
                                            {{ $item }} </a>
                                        <a href="javascript:void(0)" class="btn-tool btn-del"><i
                                                class="fas fa-times"></i></a>

                                    </li>
                                @endif
                            @endforeach

                        </ul>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('budget/') }}" class="btn btn-danger">Cancel</a>

                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')

@stop

@section('js')
    <script>
        $(function() {
            $(".btn-del").click(function() {
                var list = $(this).closest("li")
                console.log(list)
                list.remove();
            })

            $('#budget_date').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    locale: {
                        format: 'DD/MM/YYYY'
                    }
                },
                function(start, end, label) {

                });

        })
    </script>
@stop
