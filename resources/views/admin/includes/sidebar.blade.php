<div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="{{route('dashboard')}}">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Interface</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Categories
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('categories')}}">Categories List</a>
{{--                            <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>--}}
                        </nav>
                    </div>



                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsTags" aria-expanded="false" aria-controls="collapseLayoutsTags">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Tags
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayoutsTags" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('tags')}}">Tags List</a>
                            {{--                            <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>--}}
                        </nav>
                    </div>


                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsNews" aria-expanded="false" aria-controls="collapseLayoutsNews">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        News
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayoutsNews" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('news')}}">News List</a>
                            {{--                            <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>--}}
                        </nav>
                    </div>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayoutsUsers" aria-expanded="false" aria-controls="collapseLayoutsUsers">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        User Management
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayoutsUsers" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="{{route('users')}}">Users List</a>
                            {{--                            <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>--}}
                        </nav>
                    </div>
                </div>
            </div>
{{--            <div class="sb-sidenav-footer">--}}
{{--                <div class="small">Logged in as:</div>--}}
{{--                Start Bootstrap--}}
{{--            </div>--}}
        </nav>
</div>

