@extends('layouts.admin')
@section('title', 'news')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">News List</h1>
{{--        <a href="{{route('news.create')}}" type="button" class="btn btn-primary mt-4">Create</a>--}}
    </div>

    {{--    <ol class="breadcrumb mb-4">--}}
    {{--        <li class="breadcrumb-item active">Dashboard</li>--}}

    {{--    </ol>--}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('news')}}">News</a></li>
            <li class="breadcrumb-item active" aria-current="page">Media</li>
        </ol>
    </nav>
    @if(Session::has('success'))
        <div class="alert alert-success" id="success-alert" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <div class="card mb-4">
        {{--        <div class="card-header">--}}
        {{--            <i class="fas fa-table me-1"></i>--}}
        {{--            DataTable Example--}}
        {{--        </div>--}}
        <div class="card-body">
                @isset($images)

                        <div class="row d-flex align-items-center">
                            @foreach($images as $index=>$image)
                            <div class="col-md-3 d-flex align-items-center">
{{--                                <div class="img">--}}
                                    <img width="100%" height="200px" id="image-{{$index}}-{{$image->id}}" src="{{$image->image}}" alt="...">
{{--                                </div>--}}
                            </div>
                            @endforeach
                        </div>

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
