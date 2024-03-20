@extends('layouts.admin')
@section('title', 'Tags')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Tags List</h1>
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{route('tag.create')}}" type="button" class="btn btn-primary mt-4 m-1">Create</a>
            <a href="{{route('trash-tags')}}" type="button" class="btn btn-primary mt-4 m-1">Trashed</a>
        </div>
    </div>

{{--    <ol class="breadcrumb mb-4">--}}
{{--        <li class="breadcrumb-item active">Dashboard</li>--}}

{{--    </ol>--}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tags</li>
        </ol>
    </nav>
    @if(Session::has('success'))
        <div class="alert alert-success" id="success-alert" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="card mb-4">
        <div class="card-header">
            <div class="col-md-4 float-end">
                <div class="form-group">
                    <form method="get" action="{{route('search_tags')}}">
                        <div class="input-group">
                            <input type="search" class="form-control" name="search" placeholder="Search..." value="{{isset($search) ? $search : ''}}">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            <div class="card-body">
                @isset($tags)
                    @if(count($tags) > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th width="10%">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($tags as $tag)
                                        <tr>
                                            <td>{{$tag->id}}</td>
                                            <td>{{$tag->title}}</td>
                                            <td class="d-flex justify-content-between align-items-center">
                                                <a href="{{route('tag.edit', $tag->id)}}" class="btn btn-info btn-sm btn-icon mb-1">
                                                    <i class="fa fa-pencil"></i>
                                                </a>
                                                <a href="{{route('tags.soft-delete', $tag->id)}}" class="btn btn-danger btn-sm btn-icon mb-1">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                {!! $tags->links() !!}
                            </div>
                        </div>
                    @else
                        <div class="col-md-12">
                            <p class="text-center">No data found.</p>
                        </div>
                    @endif
                @endisset
            </div>
    </div>
    @section('scripts')
        <script>
            $(document).ready (function(){
                // $("#success-alert").alert();
                window.setTimeout(function () {
                    $("#success-alert").alert('close');
                }, 2000);
            });
        </script>
    @endsection
@endsection
