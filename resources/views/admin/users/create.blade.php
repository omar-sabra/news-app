@extends('layouts.admin')
{{--@section('title', 'Category || Create)--}}

@section('content')
{{--    <div class="d-flex justify-content-between align-items-center">--}}
        <h1 class="mt-4">User Create</h1>
{{--        <a href="{{route('category.create')}}" type="button" class="btn btn-primary mt-4">Create</a>--}}
{{--    </div>--}}

    {{--    <ol class="breadcrumb mb-4">--}}
    {{--        <li class="breadcrumb-item active">Dashboard</li>--}}

    {{--    </ol>--}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('users')}}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
<div class="card mb-4 p-3">
    <form method="POST" action="{{route('user.store')}}">
        @csrf
        <div class="col-md-12 mb-3">
            <label for="validationFirstName" class="form-label">First Name <span class="text-danger">*</span></label>
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" value="{{old('first_name')}}" id="validationFirstName">
            @error('first_name')
            <span class="invalid-feedback" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="validationLastName" class="form-label">Last Name <span class="text-danger">*</span></label>
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" value="{{old('last_name')}}" id="validationLastName">
            @error('last_name')
            <span class="invalid-feedback" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="validationEmail" class="form-label">Email <span class="text-danger">*</span></label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{old('email')}}" id="validationEmail">
            @error('email')
            <span class="invalid-feedback" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="validationPassword" class="form-label">Password <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="validationPassword">
            @error('password')
            <span class="invalid-feedback" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="validationConfirmPassword" class="form-label">Confirm Password <span class="text-danger">*</span></label>
            <input type="password" name="confirm_password" class="form-control" id="validationConfirmPassword">
        </div>
        <div class="col-md-12 mb-3">
            <label for="validationUsername" class="form-label">Username <span class="text-danger">*</span></label>
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{old('username')}}" id="validationUsername">
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong class="text-danger">{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <div class="form-check">
                <input class="form-check-input" name="role" type="checkbox" value="1" id="flexCheckChecked">
                <label class="form-check-label" for="flexCheckChecked">
                    Administrator
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" name="status" type="checkbox" value="1" id="flexCheckChecked">
                <label class="form-check-label" for="flexCheckChecked">
                    Enabled
                </label>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary float-end" type="submit">Save</button>
        </div>
    </form>
</div>
@endsection

