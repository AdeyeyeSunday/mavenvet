<!doctype html>
<html lang="en">

<!-- Mirrored from iqonic.design/themes/posdash/html/backend/pages-blank-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 06 Jul 2021 10:22:28 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> MVC</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="http://iqonic.design/themes/posdash/html/assets/images/favicon.ico" />
    <link rel="stylesheet" href="{{ asset('assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/backende209.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css" rel="stylesheet">
    <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/print/bootstrap-table-print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.24/webcam.js"></script>
</head>


<body class=" color-light ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->
    <!-- Wrapper Start -->
    <div class="wrapper">

        <div class="iq-sidebar  sidebar-default ">
            <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
                <a href="{{ route('Admin.dashboard') }}" class="header-logo">
                    <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid rounded-normal light-logo"
                        alt="logo">
                    <h5 class="logo-title light-logo ml-3">MVC</h5>
                </a>
                <div class="iq-menu-bt-sidebar ml-0">
                    <i class="las la-bars wrapper-menu"></i>
                </div>
            </div>

            @if (auth()->user()->userHasRole('Admin'))
                <x-Dashboard></x-Dashboard>

                <x-pos></x-pos>

                <x-Attendance></x-Attendance>

                <x-Employee></x-Employee>

                <x-Store></x-Store>
                {{-- <x-Expenditure></x-Expenditure> --}}

                <x-Clinic></x-Clinic>

                {{-- <x-bad></x-bad> --}}

                <x-Orders_Sales_Report></x-Orders_Sales_Report>

                <x-Admin_Report></x-Admin_Report>

                <x-Authorisation></x-Authorisation>
            @endif



            @if (auth()->user()->userHasRole('Cashier'))
                <x-Dashboard></x-Dashboard>
                <x-pos></x-pos>
                <x-Clinic></x-Clinic>

                {{-- <x-bad></x-bad> --}}
                <x-Employee></x-Employee>
                {{-- <x-Expenditure></x-Expenditure> --}}
                <x-Orders_Sales_Report></x-Orders_Sales_Report>
                <x-Attendance></x-Attendance>
            @endif


            @if (auth()->user()->userHasRole('Doctor'))
                <x-Dashboard></x-Dashboard>
                <x-pos></x-pos>
                <x-Clinic></x-Clinic>
                {{-- <x-bad></x-bad> --}}
                <x-Employee></x-Employee>
                {{-- <x-Expenditure></x-Expenditure> --}}
                <x-Orders_Sales_Report></x-Orders_Sales_Report>
                <x-Attendance></x-Attendance>
                <x-Admin_Report></x-Admin_Report>
            @endif

            @if (auth()->user()->userHasRole('Manager'))
                <x-Dashboard></x-Dashboard>
                <x-pos></x-pos>
                <x-Employee></x-Employee>
                <x-Store></x-Store>
                <x-Clinic></x-Clinic>
                <x-Orders_Sales_Report></x-Orders_Sales_Report>
                <x-Admin_Report></x-Admin_Report>
                <x-Attendance></x-Attendance>
            @endif
            </nav>
            <div class="p-3"></div>
            {{-- <div class="p-3">
                <center>   <p>You need Internet to update software</p>
            <a href="{{ route("Admin.update_software") }}"> <button class="btn btn-danger">Update Software</button></a></center>
              </div> --}}
        </div>
    </div>
    <div class="iq-top-navbar">
        <div class="iq-navbar-custom">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                    <i class="ri-menu-line wrapper-menu"></i>
                    <a href="index.html" class="header-logo">
                        <img src="{{ asset('assets/images/logo.png') }}" class="img-fluid rounded-normal"
                            alt="logo">
                        <h5 class="logo-title ml-3">POSDash</h5>

                    </a>
                </div>
                <div class="iq-search-bar device-search">


                    <div class="dropdown show">
                        <a href="{{ route('update2') }}" class="btn btn-primary btn-lg">Update Product</a>

                    </div>
                </div>





                @if (Session::has('pro'))
                    <center>
                        <div class="alert alert-primary" role="alert">
                            <div class="iq-alert-text">{{ Session::get('pro') }}</div>
                        </div>
                    </center>
                @endif


                @if (Session::has('update'))
                    <center>
                        <div class="alert alert-primary" role="alert">
                            <div class="iq-alert-text">{{ Session::get('update') }}</div>
                        </div>
                    </center>
                @endif



                @if (Session::has('success'))
                    <center>
                        <div class="alert alert-success" role="alert">
                            <div class="iq-alert-text">{{ Session::get('success') }}</div>
                        </div>
                    </center>
                @endif



                @if (Session::has('sale'))
                    <center>
                        <div class="alert alert-primary" role="alert">
                            <div class="iq-alert-text">{{ Session::get('sale') }}</div>
                        </div>
                    </center>
                @endif


                @if (Session::has('order'))
                    <center>
                        <div class="alert alert-primary" role="alert">
                            <div class="iq-alert-text">{{ Session::get('order') }}</div>
                        </div>
                    </center>
                @endif


                @if (Session::has('item'))
                    <center>
                        <div class="alert alert-info" role="alert">
                            <div class="iq-alert-text">{{ Session::get('item') }}</div>
                        </div>
                    </center>
                @endif
                <div class="d-flex align-items-center">

                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-label="Toggle navigation">
                        <i class="ri-menu-3-line"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto navbar-list align-items-center">

                            <div>
                                <a href="{{ route('sync') }}" class="btn btn-secondary btn-lg">
                                    Push Button
                                </a>
                            </div>
                            <li class="nav-item nav-icon dropdown caption-content">
                                <a href="#" class="search-toggle dropdown-toggle" id="dropdownMenuButton4"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ asset('assets/images/user/1.png') }}" class="img-fluid rounded"
                                        alt="user">
                                </a>
                                <div class="iq-sub-dropdown dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <div class="card shadow-none m-0">
                                        <div class="card-body p-0 text-center">
                                            <div class="media-body profile-detail text-center">
                                                <img src="{{ asset('assets/images/page-img/profile-bg.jpg') }}"
                                                    alt="profile-bg" class="rounded-top img-fluid mb-4">
                                                <img src="{{ asset('assets/images/page-img/profile-bg.jpg') }}"
                                                    alt="profile-img" class="rounded profile-img img-fluid avatar-70">
                                            </div>
                                            <div class="p-3">
                                                @if (Auth::check())
                                                    {{ auth()->user()->name }}
                                                @endif
                                                <p class="mb-0">{{ date('j F Y') }}</p>
                                                <div class="d-flex align-items-center justify-content-center mt-3">


                                                    {{-- <a href="  {{ route('profile.show') }}   "
                                                        class="btn border mr-2">Profile</a> --}}

                                                    <form action="{{ URL::to('logout') }}" method="post">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Sign
                                                            Out</button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="content-page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    @yield('content')

                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Wrapper End-->
    <footer class="iq-footer">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-inline mb-0">
                                <li class="list-inline-item"><a href="privacy-policy.html">Privacy Policy</a></li>
                                <li class="list-inline-item"><a href="terms-of-service.html">Terms of Use</a></li>
                            </ul>
                        </div>
                        <div class="col-lg-6 text-right">
                            <span class="mr-1">
                                <script data-cfasync="false" src="{{ asset('cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js') }}">
                                </script>
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>©
                            </span> <a href="#" class="">AVA Teach</a>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('assets/js/backend-bundle.min.js') }}"></script>

    <!-- Table Treeview JavaScript -->
    <script src="{{ asset('assets/js/table-treeview.js') }}"></script>

    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('assets/js/customizer.js') }}"></script>

    <!-- Chart Custom JavaScript -->
    <script async src="{{ asset('assets/js/chart-custom.js') }}"></script>

    <!-- app JavaScript -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/pos.js') }}"></script>

    @yield('scripts')

</body>
</html>
