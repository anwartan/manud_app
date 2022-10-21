@extends('adminlte::page')

@section('title', 'Press Release')

@section('content_header')
    <h1>Update Event</h1>
@stop
{{-- @section('plugins.Datatables', true) --}}
@section('plugins.bs-custom-file-input', true)
@section('content')
    <div class="row">

        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Event Information</h3>
                </div>


                <form enctype="multipart/form-data" action="{{ url('event/') }}{{ '/' . $event->id }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="card-body">

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title"
                                class="form-control @error('title')
                            is-invalid
                            @enderror"
                                id="title" placeholder="Enter name" value="{{ $event->title }}">
                            @error('title')
                                <span id="title-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5"
                                placeholder="Enter Description">{{ $event->description }}</textarea>

                            @error('description')
                                <span id="description-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tag">Tag</label>
                            <select class="custom-select rounded-0" name="tag" id="tag">
                                @foreach ($tags as $key => $item)
                                    <option value="{{ $key }}" {{ $key === $event->tag ? 'selected' : '' }}>
                                        {{ $item }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <x-adminlte-input-file accept="image/png, image/gif, image/jpeg" name="image" id="image"
                                placeholder="Choose Image">
                            </x-adminlte-input-file>
                        </div>
                        <ul class="list-unstyled">
                            <li>
                                @php
                                    $ext = strtolower(pathinfo($event->image_url, PATHINFO_EXTENSION));
                                    
                                    $icon = 'fa-file';
                                    if ($ext == 'pdf') {
                                        $icon = 'fa-file-pdf';
                                    } elseif ($ext == 'word') {
                                        $icon = 'fa-file-word';
                                    } elseif (in_array($ext, ['jpeg', 'jpg', 'png'])) {
                                        $icon = 'fa-file-image';
                                    }
                                @endphp
                                @if (!empty($event->image_url))
                                    <a target="_blank" href="{{ URL::to('/') . '/files/' . $event->image_url }}"
                                        class="btn-link text-secondary"><i class="far fa-fw {{ $icon }}"></i>
                                        {{ $event->image_url }}</a>
                                @endif

                            </li>
                        </ul>
                        <div class="form-group">
                            <label for="attachments">Attachments</label>
                            <x-adminlte-input-file multiple name="attachments[]" id="attachments"
                                placeholder="Choose Attachments">
                            </x-adminlte-input-file>
                        </div>
                        @php
                            $arrayAttachments = explode(';', $event->attachments);
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
            $(".btn-del").click(function() {
                var list = $(this).closest("li")
                console.log(list)
                list.remove();
            })
        })
    </script>
@stop
