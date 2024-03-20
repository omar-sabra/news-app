<!DOCTYPE html>
<html lang="en">

@include('admin.includes.head')
<body class="sb-nav-fixed sb-sidenav-toggled">
    @include('admin.includes.header')
    <div id="layoutSidenav">
        @include('admin.includes.sidebar')
        <div id="layoutSidenav_content" style="background-color: lightgray">
            <main>
                <div class="container-fluid px-4">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <!-- Scripts -->
    @include('admin.includes.scripts')

</body>

</html>
