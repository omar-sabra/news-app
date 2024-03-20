@extends('layouts.admin')
@section('title', 'categories')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Categories List Trashed</h1>
    </div>

{{--    <ol class="breadcrumb mb-4">--}}
{{--        <li class="breadcrumb-item active">Dashboard</li>--}}

{{--    </ol>--}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('categories')}}">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categories Trashed</li>
        </ol>
    </nav>
    <div class="card mb-4">
        <div class="card-body">
            @isset($categories)
                @if(count($categories) > 0)
                    <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>description</th>
{{--                            <th>Action</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->title}}</td>
                                    <td>{{$category->description}}</td>
{{--                                    <td class="d-flex justify-content-between align-items-center">--}}
{{--                                        <a href="{{route('category.edit', $category->id)}}" class="btn btn-info btn-sm btn-icon mb-1">--}}
{{--                                            <i class="fa fa-pencil"></i>--}}
{{--                                        </a>--}}
{{--                                        <a href="{{route('category.destroy', $category->id)}}" class="btn btn-danger btn-sm btn-icon mb-1">--}}
{{--                                            <i class="fa fa-trash"></i>--}}
{{--                                        </a>--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        {!! $categories->links() !!}
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
