@extends('layouts.admin')
@section('title', 'news')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">News List Trashed</h1>
{{--        <a href="{{route('news.create')}}" type="button" class="btn btn-primary mt-4">Create</a>--}}
    </div>

{{--    <ol class="breadcrumb mb-4">--}}
{{--        <li class="breadcrumb-item active">Dashboard</li>--}}

{{--    </ol>--}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('news')}}">News</a></li>
            <li class="breadcrumb-item active" aria-current="page">News Trashed</li>
        </ol>
    </nav>
    <div class="card mb-4">
{{--        <div class="card-header">--}}
{{--            <i class="fas fa-table me-1"></i>--}}
{{--            DataTable Example--}}
{{--        </div>--}}
        <div class="card-body">
            @isset($news)
                @if(count($news) > 0)
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th width="30%">description</th>
                            <th>Custom Date</th>
                            <th>Category</th>
                            <th>Tags</th>
                            <th>View Media</th>
{{--                            <th width="80px">Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>

                            @foreach($news as $new)
                                <tr>
                                    <td>{{$new->id}}</td>
                                    <td>
                                        <img class="image"
                                             style="width: 50px !important; height: 50px !important; border-radius: 50% !important;"
                                             @if($new->image) src="{{$new->image}}"
                                             @else src="{{asset('/assets/img/placeholder.jpg')}}"@endif>
                                    </td>
                                    <td>{{$new->title}}</td>
                                    <td>{{$new->description}}</td>
                                    <td>{{$new->custom_date}}</td>
                                    <td>{{$new->category->title}}</td>
                                    <td>{{$new->tag}}</td>
                                    <td>
                                        @if(count($new->media) > 0)
                                            <a href="{{route('news.view-media', $new->id)}}" class="btn btn-info btn-sm btn-icon mb-1">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        @endif
                                    </td>
{{--                                    <td class="d-flex justify-content-between align-items-center">--}}
{{--                                        <a href="{{route('news.edit', $new->id)}}" class="btn btn-info btn-sm btn-icon mb-1">--}}
{{--                                            <i class="fa fa-pencil"></i>--}}
{{--                                        </a>--}}
{{--                                        <a href="{{route('news.soft-delete', $new->id)}}" class="btn btn-danger btn-sm btn-icon mb-1">--}}
{{--                                            <i class="fa fa-trash"></i>--}}
{{--                                        </a>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {!! $news->links() !!}
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
@endsection
