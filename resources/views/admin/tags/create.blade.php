@extends('layouts.admin')
{{--@section('title', 'Category || Create)--}}

@section('content')
{{--    <div class="d-flex justify-content-between align-items-center">--}}
        <h1 class="mt-4">Tag Create</h1>
{{--        <a href="{{route('category.create')}}" type="button" class="btn btn-primary mt-4">Create</a>--}}
{{--    </div>--}}

    {{--    <ol class="breadcrumb mb-4">--}}
    {{--        <li class="breadcrumb-item active">Dashboard</li>--}}

    {{--    </ol>--}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('tags')}}">Tags</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
<div class="card mb-4 p-3">
    <form method="POST" action="{{route('tag.store')}}">
        @csrf
        <div class="col-md-12 mb-3">
            <label for="validationTitle" class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="validationTitle">
            @if($errors->has('title'))
                <span class="invalid-feedback" role="alert">
                    <strong class="text-danger">{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
        <div class="mb-3">
            <button class="btn btn-primary float-end" type="submit">Save</button>
        </div>
    </form>
</div>
@endsection

