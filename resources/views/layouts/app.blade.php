<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @include('flash::message')
            @yield('content')
        </main>
    </div>
    <script>
        // Untuk menampilkan pesan kesalahan pada password saat validasi gagal
        let passwordInput = document.getElementById('password');
        let passwordError = document.getElementById('password-error');

        passwordInput.addEventListener('invalid', function(event) {
            event.preventDefault();
            if (!event.target.validity.valid) {
                passwordError.textContent = 'Password harus kuat dan memenuhi persyaratan yang ditetapkan.';
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    <script>
        document.getElementById('password').addEventListener('input', function() {
            var password = document.getElementById('password').value;
            var result = zxcvbn(password);
            var strengthMeter = document.getElementById('password-strength');

            var strength = {
                0: 'Very Weak',
                1: 'Weak',
                2: 'Fair',
                3: 'Strong',
                4: 'Very Strong'
            };

            var score = result.score;
            var feedback = result.feedback.warning || '';

            strengthMeter.innerHTML = '<div class="progress">' +
                '<div class="progress-bar bg-' + getProgressBarColor(score) +
                '" role="progressbar" style="width: ' + (score * 20) + '%" aria-valuenow="' + (score * 20) +
                '" aria-valuemin="0" aria-valuemax="100"></div>' +
                '</div>' +
                '<div class="mt-1">' + strength[score] + '</div>' +
                '<div class="mt-1">' + feedback + '</div>';
        });

        function getProgressBarColor(score) {
            if (score <= 1) {
                return 'danger';
            } else if (score <= 2) {
                return 'warning';
            } else if (score <= 3) {
                return 'info';
            } else {
                return 'success';
            }
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>
    <script>
        document.getElementById('password').addEventListener('input', function() {
            var password = document.getElementById('password').value;
            var result = zxcvbn(password);
            var strengthMeter = document.getElementById('password-strength');

            var strength = {
                0: 'Very Weak',
                1: 'Weak',
                2: 'Fair',
                3: 'Strong',
                4: 'Very Strong'
            };

            var score = result.score;
            var feedback = result.feedback.warning || '';

            strengthMeter.innerHTML = '<div class="progress">' +
                '<div class="progress-bar bg-' + getProgressBarColor(score) +
                '" role="progressbar" style="width: ' + (score * 20) + '%" aria-valuenow="' + (score * 20) +
                '" aria-valuemin="0" aria-valuemax="100"></div>' +
                '</div>' +
                '<div class="mt-1">' + strength[score] + '</div>' +
                '<div class="mt-1">' + feedback + '</div>';
        });

        document.getElementById('togglePassword').addEventListener('click', function() {
            var passwordInput = document.getElementById('password');
            var toggleButton = document.getElementById('togglePassword');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleButton.textContent = 'Hide';
            } else {
                passwordInput.type = 'password';
                toggleButton.textContent = 'Show';
            }
        });

        function getProgressBarColor(score) {
            if (score <= 1) {
                return 'danger';
            } else if (score <= 2) {
                return 'warning';
            } else if (score <= 3) {
                return 'info';
            } else {
                return 'success';
            }
        }
    </script>
</body>

</html>
