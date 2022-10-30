@extends('adminlte::page')

@section('title', 'Layanan')

@section('content_header')
    <h1>Update Layanan</h1>
@stop
{{-- @section('plugins.Datatables', true) --}}
@section('plugins.bs-custom-file-input', true)
@section('plugins.daterangepicker', true)

@section('content')
    <div class="row">

        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Layanan Information</h3>
                </div>


                <form enctype="multipart/form-data" action="{{ url('layanan/') }}{{ '/' . $layanan->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" name="name"
                                class="form-control @error('name')
                            is-invalid
                            @enderror"
                                id="name" placeholder="Enter name" value="{{ $layanan->name }}">
                            @error('name')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="budget_date">Doctor Schedule</label>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-calendar-alt"></i>
                                    </span>
                                </div>
                                <input type="text" value="{{ $layanan->getSchedule() }}" name="schedule"
                                    class="form-control float-right @error('schedule')
                                    is-invalid
                                    @enderror"
                                    id="schedule">
                                @error('schedule')
                                    <span id="schedule-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">

                            <label for="title">Link Url</label>
                            <div class="input-group input-group-sm">
                                <input type="text" name="link_url"
                                    class="form-control @error('link_url')
                            is-invalid
                            @enderror"
                                    id="link_url" placeholder="Enter Link Url" value="{{ $layanan->link_url }}">
                                <span class="input-group-append">
                                    <button type="button" id="openLink" class="btn btn-info btn-flat">Open
                                        Link</button>
                                </span>
                                @error('link_url')
                                    <span id="title-error" class="error invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('layanan/') }}" class="btn btn-danger">Cancel</a>

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

            $('#schedule').daterangepicker({

                    timePicker: true,
                    singleDatePicker: true,
                    showDropdowns: true,
                    locale: {
                        format: 'DD/MM/YYYY hh:mm A'
                    },

                },
                function(start, end, label) {

                });
            $("#openLink").click(function() {
                var link = $("#link_url").val()

                window.open(link, "_blank")
            })
        })
    </script>
@stop
