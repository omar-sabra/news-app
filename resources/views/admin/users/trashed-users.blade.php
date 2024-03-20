@extends('layouts.admin')
@section('title', 'Tags')
@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mt-4">Users List Trashed</h1>
{{--        <div class="d-flex justify-content-between align-items-center">--}}
{{--            <a href="{{route('user.create')}}" type="button" class="btn btn-primary mt-4 m-1">Create</a>--}}
{{--            <a href="{{route('trash-users')}}" type="button" class="btn btn-primary mt-4 m-1">Trashed</a>--}}
{{--        </div>--}}
    </div>

    {{--    <ol class="breadcrumb mb-4">--}}
    {{--        <li class="breadcrumb-item active">Dashboard</li>--}}

    {{--    </ol>--}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('users')}}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Trashed</li>
        </ol>
    </nav>
    <div class="card mb-4">
        <div class="card-body">
            @isset($users)
                @if(count($users) > 0)
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>User</th>
                                <th>Role</th>
                                <th>Status</th>
                                {{--                                    <th>Joined Date</th>--}}
                                <th width="10%">Action</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>
                                        {{$user->id}}
                                    </td>

                                    <td>
                                        <div class="row">
                                            {{$user->first_name}} {{$user->last_name}}
                                        </div>
                                        <div class="row">{{$user->email}}</div>
                                    </td>
                                    <td>
                                        @if($user->role == 0)
                                            <span class="badge bg-success">Administrator</span>
                                        @else
                                            <span class="badge bg-secondary">User</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($user->status == 0)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-between align-items-center">
                                        <a href="{{route('user.edit', $user->id)}}" class="btn btn-info btn-sm btn-icon mb-1">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="{{route('users.soft-delete', $user->id)}}" class="btn btn-danger btn-sm btn-icon mb-1">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            {!! $users->links() !!}
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


        $(document).ready(function () {
            $('#edit-status').change(function (event) {
                event.preventDefault();
                var id = $(this).attr('data-id');
                $.ajax({
                        url: "{{ route('edit_status_user') }}",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            id: id
                        },
                        success: function (data) {
                            if (data.status === 1) {
                                $('#edit-status').prop("checked", true);
                            } else {
                                $('#edit-status').prop("checked", false);
                            }
                        }
                    }
                )
            });
        });

        {{--$(document).ready(function () {--}}
        {{--    $('.form-check-input').click(function (event) {--}}
        {{--        event.preventDefault();--}}
        {{--        var id = $(this).attr('id');--}}
        {{--        $.ajax({--}}
        {{--                url: "{{ route('edit_status_user') }}",--}}
        {{--                type: 'POST',--}}
        {{--                dataType: 'json',--}}
        {{--                data: {--}}
        {{--                    "_token": "{{ csrf_token() }}",--}}
        {{--                    id: id--}}
        {{--                },--}}
        {{--                success: function (data) {--}}
        {{--                    if (data.status === 0) {--}}
        {{--                        $(this).prop('checked', true);--}}
        {{--                    } else {--}}
        {{--                        $(this).prop('checked', false);--}}
        {{--                    }--}}
        {{--                }--}}
        {{--            }--}}

        {{--        )--}}
        {{--    });--}}
        {{--})--}}
    </script>
@endsection
@endsection
