@push('css')
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('assets/img/brand/favicon.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->

    <link rel="stylesheet" href="../../../assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="../../../assets/vendor/fortawesome/fontawesome-free/css/all.min.css" type="text/css">

    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/argon.css?v=1.1.0') }}" type="text/css">

    <body class="bg-default">

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />


        <!-- Main content -->
        <div class="main-content">
            <!-- Header -->
            <div class="header bg-gradient-primary py-7 py-lg-8 pt-lg-9">
                <div class="container">
                    <div class="header-body text-center mb-7">
                        <div class="row justify-content-center">
                            <div class="col-xl-5 col-lg-6 col-md-8 px-5">
                                <h1 class="text-white">Welcome!</h1>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <!-- Validation Errors -->
                            @if (session()->get('errors'))
                                <div class="alert alert-danger col-lg-6" role="alert" :errors="$errors">
                                    {{ session()->get('errors') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="separator separator-bottom separator-skew zindex-100">
                    <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                        xmlns="http://www.w3.org/2000/svg">
                        <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
                    </svg>
                </div>
            </div>
            <!-- Page content -->
            <div class="container mt--8 pb-5">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-7">
                        <div class="card bg-secondary border-0 mb-0">
                            <div class="card-body px-lg-5 py-lg-5">
                                <div class="text-center text-muted mb-4">
                                    <small> Sign in with credentials</small>
                                </div>
                                <form role="form" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                            </div>
                                            <input class="form-control" placeholder="Email" type="email" name="email"
                                                :value="old('email')" required autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group input-group-merge input-group-alternative">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                            </div>
                                            <input class="form-control block mt-1 w-full" placeholder="Password"
                                                type="password" name="password" required autocomplete="current-password">
                                        </div>
                                    </div>
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" id=" customCheckLogin" type="checkbox">
                                        <label class="custom-control-label" for=" customCheckLogin">
                                            <span class="text-muted">{{ __('Remember me') }}</span>
                                        </label>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-primary my-4">{{ __('Log in') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-3">
                            {{-- <div class="col-6">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="text-light"><small>{{ __('Forgot your password?') }}</small></a>
                                @endif
                            </div> --}}
                            {{-- <div class="col-6 text-right">
                                <a href="{{ route('register') }}" class="text-light"><small>Create new
                                        account</small></a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <!-- Core -->
    <script src="../../assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="../../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/vendor/js-cookie/js.cookie.js"></script>
    <script src="../../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
    <script src="../../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
    <!-- Argon JS -->
    <script src="../../assets/js/argon.js?v=1.1.0"></script>
    <!-- Demo JS - remove this in your project -->
    <script src="../../assets/js/demo.min.js"></script>
