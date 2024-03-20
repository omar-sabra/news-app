@extends('layouts.admin')
@section('title', 'Tags')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Tags List Trashed</h1>
{{--        <a href="{{route('tag.create')}}" type="button" class="btn btn-primary mt-4">Create</a>--}}
    </div>

{{--    <ol class="breadcrumb mb-4">--}}
{{--        <li class="breadcrumb-item active">Dashboard</li>--}}

{{--    </ol>--}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('tags')}}">Tags</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tags Trashed</li>
        </ol>
    </nav>
{{--    @if(Session::has('success'))--}}
{{--        <div class="alert alert-success" id="success-alert" role="alert">--}}
{{--            {{ Session::get('success') }}--}}
{{--        </div>--}}
{{--    @endif--}}
    <div class="card mb-4">
        @isset($tags)
            @if(count($tags) > 0)
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
{{--                            <th width="10%">Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <td>{{$tag->id}}</td>
                                    <td>{{$tag->title}}</td>
{{--                                    <td class="d-flex justify-content-between align-items-center">--}}
{{--                                        <a href="{{route('tag.edit', $tag->id)}}" class="btn btn-info btn-sm btn-icon mb-1">--}}
{{--                                        <i class="fa fa-pencil"></i>--}}
{{--                                    </a>--}}
{{--                                    <a href="{{route('tag.destroy', $tag->id)}}" class="btn btn-danger btn-sm btn-icon mb-1">--}}
{{--                                        <i class="fa fa-trash"></i>--}}
{{--                                    </a>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {!! $tags->links() !!}
                    </div>
                </div>
            </div>
            @else
                <div class="col-md-12">
                    <p class="text-center">No data found.</p>
                </div>
            @endif
        @endisset
    </div>
@endsection
