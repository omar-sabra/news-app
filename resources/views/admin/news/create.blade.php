@extends('layouts.admin')
{{--@section('title', 'Category || Create)--}}
@section('style')
    <style>
        /*ul#tabs-nav li:hover,*/
        ul#tabs-nav li.active {
            /*background-color: lightgray;*/
            border-bottom: 2px solid  #08E;
        }

        #tabs-nav li a {
            text-decoration: none;
            color: #4b5155;
        }

        ul#tabs-nav li.active a {
            color: #08E;
        }
    </style>
@endsection
@section('content')
{{--    <div class="d-flex justify-content-between align-items-center">--}}
        <h1 class="mt-4">News Create</h1>
{{--        <a href="{{route('category.create')}}" type="button" class="btn btn-primary mt-4">Create</a>--}}
{{--    </div>--}}

    {{--    <ol class="breadcrumb mb-4">--}}
    {{--        <li class="breadcrumb-item active">Dashboard</li>--}}

    {{--    </ol>--}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('news')}}">News</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>
<div class="card mb-4 p-3">
    <ul class="nav nav-tabs" id="tabs-nav">
        <li class="nav-item">
            <a class="nav-link" aria-current="page" data-target="tab-1" href="#tab1">Information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-target="tab-2" href="#tab2">Media</a>
        </li>
    </ul>
    <div id="tabs-content">
    <form method="POST" action="{{route('news.store')}}" enctype="multipart/form-data">
        @csrf
        <div id="tab1" class="tab-content">
            <div class="col-md-12 mb-3">
                <label for="validationTitle" class="form-label">Title <span class="text-danger">*</span></label>
                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="validationTitle">
                @if($errors->has('title'))
                    <span class="invalid-feedback" role="alert">
                    <strong class="text-danger">{{ $errors->first('title') }}</strong>
                </span>
                @endif
            </div>
            <div class="col-md-12 mb-3">
                <label for="validationDescription" class="form-label">Description <span class="text-danger">*</span></label>
                <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="summernote"></textarea>

                @if($errors->has('description'))
                    <span class="invalid-feedback" role="alert">
                    <strong class="text-danger">{{ $errors->first('description') }}</strong>
                </span>
                @endif
            </div>
            <div class="col-md-12 mb-3">
                <select class="form-select" name="category_id" aria-label="Default select example">
                    @foreach ($categories as $category )
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
{{--                @if($errors->has('category_id'))--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                    <strong class="text-danger">{{ $errors->first('category_id') }}</strong>--}}
{{--                </span>--}}
{{--                @endif--}}
            </div>
            <div class="col-md-12 mb-3">
                <select class="form-select" name="tags[]" multiple aria-label="multiple select example">
{{--                    <option selected>Choose Tags...</option>--}}
                    @foreach ($tags as $tag )
                        <option value="{{ $tag->id }}">{{ $tag->title }}</option>
                    @endforeach
                </select>
{{--                @if($errors->has('tag'))--}}
{{--                    <span class="invalid-feedback" role="alert">--}}
{{--                    <strong class="text-danger">{{ $errors->first('tag') }}</strong>--}}
{{--                </span>--}}
{{--                @endif--}}
            </div>
        </div>
        <div id="tab2" class="tab-content">
            <div class="row m-3 p-0" id="images">
                <div class="col-md-4 p-0" id="plus">
                    <button
                        style="font-size: x-small; line-height: 2; width: fit-content;position: relative; top: 30%;transform: translateY(-30%); !important;"
                        id="addImageRow" type="button" class="btn btn-primary add_image"><i
                            class="fa fa-plus"></i> Add photo
                    </button>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary float-end" type="submit">Save</button>
        </div>
    </form>
</div>
    @section('scripts')
        <script>
            $('#summernote').summernote({
                placeholder: 'description...',
                tabsize: 2,
                height: 100
            });

            // Show the first tab and hide the rest
            $('#tabs-nav li:first-child').addClass('active');
            $('.tab-content').hide();
            $('.tab-content:first').show();

            // Click function
            $('#tabs-nav li').click(function(){
                $('#tabs-nav li').removeClass('active');
                $(this).addClass('active');
                $('.tab-content').hide();

                var activeTab = $(this).find('a').attr('href');
                $(activeTab).fadeIn();
                return false;
            });

            // Add image row

            var counter = 0;
            $('#addImageRow').on('click', function () {
                counter = counter + 1;
                var html = '';
                html += '<div class ="col-md-4" id="new_image">';
                html += '<div class="form-group">';
                html += '<img id="img_' + counter + '" class="fa-square" style="width: 100%; height: 158px;" src="{{asset('/assets/img/placeholder.jpg')}}">';
                html += '</div>';
                html += '<div class="form-group">';
                html += '<label>Add Photo <span class="text-danger">*</span></label>';
                html += '<input type="file" style="margin-bottom: 10px" class="form-control" name="images[]" onchange="document.getElementById( `img_' + counter + '`).src = window.URL.createObjectURL(this.files[0])" multiple>';
                html += `<a class="btn btn-danger text-center" style="margin-bottom: 10px" id="removeImageRow"><i class="fa fa-trash"></i></a>`;
                html += '</div>';
                html += '</div>';
                $('#plus').before(html);
            });

            {{-- delete image js --}}
            $(document).on('click', '#removeImageRow', function (event) {
                event.preventDefault();
                $(this).closest('#new_image').remove();
            });
            {{-- / delete image js --}}
        </script>
    @endsection
@endsection

