{{-- <x-guest-layout>
    <div class="col-md-8">
    <x-jet-authentication-card>

        <x-slot name="logo">
          <center>  <img width="135px" height="145px" src="{{asset('image/WILLIAMS LOGO (1).png')}}" alt=""></center>
        </x-slot>

        <div class="card-body">
            <x-jet-validation-errors class="mb-8 rounded-0" />
            @if (session('status'))
                <div class="alert alert-success mb-3 rounded-0" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <x-jet-label value="{{ __('Email') }}" />

                    <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                 name="email" :value="old('email')" required />
                    <x-jet-input-error for="email"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <x-jet-label value="{{ __('Password') }}" />

                    <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                                 name="password" required autocomplete="current-password" />
                    <x-jet-input-error for="password"></x-jet-input-error>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <x-jet-checkbox id="remember_me" name="remember" />
                        <label class="custom-control-label" for="remember_me">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">
                        @if (Route::has('password.request'))
                            <a class="text-muted mr-3" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-jet-button>
                            {{ __('Log in') }}
                        </x-jet-button>

                        <div class="mb-0">
                            <div class="d-flex justify-content-end align-items-baseline">
                        <a class="text-muted mr-3" href="{{ __('register') }}">
                            {{ __('Register') }}
                        </a>
                    </div>
                </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

    </x-jet-authentication-card>
</x-guest-layout> --}}






<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>MVC</title>
    <link rel="shortcut icon" href="http://iqonic.design/themes/posdash/html/assets/images/favicon.ico" />
    <link rel="stylesheet" href="{{ asset('assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/backende209.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/remixicon/fonts/remixicon.css') }}">

<body class=" ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->

    <div class="wrapper">
        <section class="login-content">
            <div class="container">
                <div class="row align-items-center justify-content-center height-self-center">
                    <div class="col-lg-8">
                        <div class="card auth-card">
                            <div class="card-body p-0">
                                <div class="d-flex align-items-center auth-content">
                                    <div class="col-lg-7 align-self-center">
                                        <div class="p-3">
                                            <h2 class="mb-2">Maven Veterinary Consult</h2>
                                            <p>Login to stay connected.</p>
                                            <form method="POST" action="{{ route('login') }}">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="floating form-group">
                                                            <x-jet-label value="{{ __('Email') }}" />
                                                            <input
                                                                class="{{ $errors->has('email') ? 'is-invalid' : '' }} form-control"
                                                                type="email" name="email" :value="old('email')"
                                                                requiredtype="email" required placeholder="Enter email">
                                                            <x-jet-input-error for="email"></x-jet-input-error>

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="floating form-group">
                                                            <x-jet-label value="{{ __('Password') }}" />
                                                            <input
                                                                class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                                type="password" name="password" required
                                                                autocomplete="current-password"
                                                                placeholder="Enter password">
                                                            <x-jet-input-error for="password"></x-jet-input-error>

                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="btn sidebar-bottom-btn mt-4 btn-lg btn-block">Sign
                                                    In</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 content-right">
                                        <img src="{{ asset("assets/images/login/logobig.png") }}" class="img-fluid image-right"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
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

</body>

</html>
