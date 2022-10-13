@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Update User</h1>
@stop
{{-- @section('plugins.Datatables', true) --}}

@section('content')
    <div class="row">

        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">User Information</h3>
                </div>


                <form action="{{ url('admin/user/update/') }}{{ '/' . $user->id }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <input type="hidden" name="id" value="{{ $user->id }}">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name"
                                class="form-control @error('first_name')
                            is-invalid
                            @enderror"
                                id="first_name" placeholder="Enter name" value="{{ $user->first_name }}">
                            @error('first_name')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name"
                                class="form-control @error('last_name')
                            is-invalid
                            @enderror"
                                id="last_name" placeholder="Enter name" value="{{ $user->last_name }}">
                            @error('last_name')
                                <span id="name-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="emailAddress">Email address</label>
                            <input type="email" name="email" readonly
                                class="form-control @error('email')
                            is-invalid
                            @enderror"
                                id="emailAddress" placeholder="Enter email" value="{{ $user->email }}">
                            @error('email')
                                <span id="email-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="custom-select rounded-0" id="role" name="role">
                                <option value="ADMIN" @if ($user->role === 'ADMIN') selected @endif>ADMIN</option>
                                <option value="SUPER_ADMIN" @if ($user->role === 'SUPER_ADMIN') selected @endif>SUPER ADMIN
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password"
                                class="form-control @error('password')
                            is-invalid
                            @enderror"
                                id="password" placeholder="Password">
                            @error('password')
                                <span id="password-error" class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <input type="password" name="password_confirmation"
                                class="form-control @error('password_confirmation')
                            is-invalid
                            @enderror"
                                id="password_confirmation" placeholder="Password">
                            @error('password_confirmation')
                                <span id="password_confirmation-error"
                                    class="error invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ url('admin/user/') }}" class="btn btn-danger">Cancel</a>
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
        console.log('Hi!');
    </script>
@stop
