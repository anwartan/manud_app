@extends('adminlte::page')

@section('title', 'Information & Event')

@section('content_header')
    <h1>Create Information & Event</h1>
@stop
{{-- @section('plugins.Datatables', true) --}}
@section('plugins.bs-custom-file-input', true)
@section('content')
    <div class="row">

        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Information & Event</h3>
                </div>


                <form enctype="multipart/form-data" action="{{ url('event/') }}" method="POST">
                    @csrf

                    <div class="card-body">

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title"
                                class="form-control @error('title')
                            is-invalid
                            @enderror"
                                id="title" placeholder="Enter name" value="{{ old('title') }}">
                            @error('title')
                                <span id="title-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5"
                                placeholder="Enter Description">{{ old('description') }}</textarea>

                            @error('description')
                                <span id="description-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tag">Tag</label>
                            <select class="custom-select rounded-0" name="tag" id="tag">
                                @foreach ($tags as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">

                            <label for="title">Link Url</label>
                            <div class="input-group input-group-sm">
                                <input type="text" name="link_url"
                                    class="form-control @error('link_url')
                            is-invalid
                            @enderror"
                                    id="link_url" placeholder="Enter Link Url" value="{{ old('link_url') }}">
                                <span class="input-group-append">
                                    <button type="button" id="openLink" class="btn btn-info btn-flat">Open
                                        Link</button>
                                </span>
                            </div>
                            @error('link_url')
                                <span id="title-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <x-adminlte-input-file accept="image/png, image/gif, image/jpeg" name="image" id="image"
                                placeholder="Choose Image">
                            </x-adminlte-input-file>
                        </div>
                        <div class="form-group">
                            <label for="attachments">Attachments</label>
                            <x-adminlte-input-file multiple name="attachments[]" id="attachments"
                                placeholder="Choose Attachments">
                            </x-adminlte-input-file>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('event/') }}" class="btn btn-danger">Cancel</a>

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
            $("#openLink").click(function() {
                var link = $("#link_url").val()

                window.open(link, "_blank")
            })
        })
    </script>
@stop
