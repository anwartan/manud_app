@extends('adminlte::page')

@section('title', 'Profile')

@section('content_header')
    <h1>Profile</h1>
@stop
@section('plugins.bs-custom-file-input', true)

@section('content')
    <div class="row">
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
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Profile Information</h3>
                </div>


                <form enctype="multipart/form-data" action="{{ url('profile') }}{{ '/' . $profile->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <input type="hidden" name="id" value="{{ $profile->id }}">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name"
                                class="form-control @error('name')
                        is-invalid
                        @enderror"
                                id="name" placeholder="Enter name" value="{{ $profile->name }}">
                            @error('name')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="5"
                                placeholder="Enter Description">{{ $profile->description }}</textarea>

                            @error('description')
                                <span id="description-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
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
                                    $ext = strtolower(pathinfo($profile->image_url, PATHINFO_EXTENSION));
                                    
                                    $icon = 'fa-file';
                                    if ($ext == 'pdf') {
                                        $icon = 'fa-file-pdf';
                                    } elseif ($ext == 'word') {
                                        $icon = 'fa-file-word';
                                    } elseif (in_array($ext, ['jpeg', 'jpg', 'png'])) {
                                        $icon = 'fa-file-image';
                                    }
                                @endphp
                                @if (!empty($profile->image_url))
                                    <a target="_blank" href="{{ URL::to('/') . '/files/' . $profile->image_url }}"
                                        class="btn-link text-secondary"><i class="far fa-fw {{ $icon }}"></i>
                                        {{ $profile->image_url }}</a>
                                @endif

                            </li>
                        </ul>


                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
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
        $(document).ready(function() {


        });
    </script>
@stop
