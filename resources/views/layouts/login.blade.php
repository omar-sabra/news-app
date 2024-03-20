<!DOCTYPE html>
<html lang="en">

@include('admin.includes.head')

<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            @if(Session::has('error'))
                                <div class="alert alert-danger" id="success-alert" role="alert">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                            <div class="card-body">
                                <form method="POST" action="{{route('login')}}">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('email') is-invalid @enderror" id="inputEmail" type="email" name="email" placeholder="name@example.com" />
                                        <label for="inputEmail">Email address</label>
                                        @if($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input class="form-control @error('password') is-invalid @enderror" id="inputPassword" type="password" name="password" placeholder="Password" />
                                        <label for="inputPassword">Password</label>
                                        @if($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong class="text-danger">{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
{{--                                        <a class="small" href="password.html">Forgot Password?</a>--}}
                                        <button class="btn btn-primary" type="submit">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
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
@include('admin.includes.scripts')
</body>

</html>
