<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> MVC</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="http://iqonic.design/themes/posdash/html/assets/images/favicon.ico" />
    <link rel="stylesheet" href="{{ asset('assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/backende209.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/remixicon/fonts/remixicon.css') }}">
    <link href="{{ asset("https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css") }}" rel="stylesheet">
    <script src="{{ asset("https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js") }}"></script>
    <script src="{{ asset("https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/print/bootstrap-table-print.min.js") }}"></script>
    <script type="text/javascript" src="{{ asset("https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.24/webcam.js") }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
</head>

<body class=" color- ">
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
                  <img src="{{ asset('assets/images/logo.png') }}" style="height: 6em;"
                        alt="logo">
                </a>
                <h5 class="logo-title -logo ml-3">Mavenvet</h5>
            </div>
            @if (auth()->user()->userHasRole('Admin'))
                <x-Dashboard></x-Dashboard>
                <x-pos></x-pos>
                <x-Attendance></x-Attendance>
                <x-Employee></x-Employee>
                <x-Store></x-Store>
                <x-Clinic></x-Clinic>
                <x-Orders_Sales_Report></x-Orders_Sales_Report>
                <x-Admin_Report></x-Admin_Report>
                <x-Authorisation></x-Authorisation>
            @endif



            @if (auth()->user()->userHasRole('Cashier'))
                <x-Dashboard></x-Dashboard>
                <x-pos></x-pos>
                <x-Clinic></x-Clinic>
                <x-Employee></x-Employee>
                <x-Orders_Sales_Report></x-Orders_Sales_Report>
                <x-Attendance></x-Attendance>
            @endif


            @if (auth()->user()->userHasRole('Doctor'))
                <x-Dashboard></x-Dashboard>
                <x-pos></x-pos>
                <x-Clinic></x-Clinic>
                <x-Employee></x-Employee>
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
            {{-- <div class="p-3"></div> --}}
            <hr>
            <div class="p-3">
                @php
                    $verstion = App\Models\Systemupdate::first();
                @endphp
                <center>
                    <div class="header-title">
                    <p class="card-title">Software version {{ $verstion->version }}</p>
                    <p class="card-title">Last update: {{ $verstion->updated_at->format('d-m-Y') }}</p>

                    <a href="{{ route('Admin.update_software') }}">
                        <button class="btn sidebar-bottom-btn mt-4 btn-lg">Click to update software</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="iq-top-navbar">
        <div class="iq-navbar-custom">
            <nav class="navbar navbar-expand-lg navbar- p-0">

                <div class="iq-search-bar device-search">

                    <div class="dropdown show">
                        <a href="{{ route('update2') }}" class="btn sidebar-bottom-btn btn-lg">Update product</a>

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



                {{-- @if (Session::has('success'))
                    <center>
                        <div class="alert alert-success" role="alert">
                            <div class="iq-alert-text">{{ Session::get('success') }}</div>
                        </div>
                    </center>
                @endif --}}



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
                    <p> {{ Session::get('item') }}</p>
                @endif


                @if (Session::has('item_not'))
                    <p> {{ Session::get('item_not') }}</p>
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
                                <a href="{{ route('sync') }}" class="btn btn-dark btn-lg">
                                    Push button
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
                            <p>Contact the developer Email:<a href="#" class=""> adeyeye005@gmail.com</a>.
                                Phone: 08026456658</p>
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

    <script>
        // Variable to keep track of whether both input fields have been filled
        var cashFilled = false;
        var transferFilled = false;

        function validatePayment() {
            // Get the entered payment amount from both input fields
            var cashAmount = parseFloat(document.getElementById('cashInput').value) || 0;
            var transferAmount = parseFloat(document.getElementById('transferInput').value) || 0;

            // Check if both input fields have been filled
            if (cashAmount !== 0 && transferAmount !== 0) {
                // Mark both input fields as filled
                cashFilled = true;
                transferFilled = true;

                // Get the total amount
                var totalAmount = parseFloat(document.querySelector('[name="pay"]').value);

                // Calculate the total entered amount
                var totalEnteredAmount = cashAmount + transferAmount;

                // Check if the entered amount is not equal to the total amount
                if (totalEnteredAmount !== totalAmount) {
                    alert("The entered payment amount does not match the total amount. Please enter the correct payment.");
                }
            } else {
                // Reset the filled status if any input field is cleared
                cashFilled = false;
                transferFilled = false;
            }
        }
    </script>

    <script>
        // Get references to the select element and text input fields
        var modeOfPaymentSelect = document.getElementById('modeOfPayment');
        var cashField = document.getElementById('cashField');
        var cashFieldPos = document.getElementById('cashFieldPos');
        var posField = document.getElementById('posField');
        var transferField = document.getElementById('transferField');
        var cashInput = document.getElementById('cashInput');
        var transferInput = document.getElementById('transferInput');
        var totalAmountInput = document.getElementById('totalAmount');

        cashField.style.display = 'none';
        transferField.style.display = 'none';
        cashFieldPos.style.display = 'none';
        posField.style.display = 'none';
        // Add event listener to the select element
        modeOfPaymentSelect.addEventListener('change', function() {
            // Hide both text input fields initially
            cashField.style.display = 'none';
            transferField.style.display = 'none';
            cashFieldPos.style.display = 'none';
            posField.style.display = 'none';
            // Get the selected option value
            var selectedOption = modeOfPaymentSelect.value;

            // Show corresponding text input fields based on the selected option
            if (selectedOption === 'Cash' || selectedOption === 'Pos' || selectedOption === 'Transfer') {
                cashField.style.display = 'none';
            } else if (selectedOption === 'cash_transfer') {
                cashField.style.display = 'block';
                transferField.style.display = 'block';
            } else if (selectedOption === 'cash_pos') {
                cashFieldPos.style.display = 'block';
                posField.style.display = 'block';
            }
        });
    </script>


</body>

</html>
