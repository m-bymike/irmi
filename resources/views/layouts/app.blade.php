<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- icons -->
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="icon" type="image/png" href="/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @stack('styles')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body class="@stack('body-class')">
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <svg version="1.1" viewBox="0 0 100 100" style="height: 100%;">
                            <g transform="rotate(45, 50, 50)">
                                <path
                                    d="M50.014,30.694c-1.189,0-2.302,0.563-3.133,1.589c-0.063,0.078-0.096,0.173-0.096,0.272v0.722   c0,0.237,0.193,0.43,0.431,0.43h5.595c0.238,0,0.43-0.193,0.43-0.43v-0.722c0-0.099-0.033-0.194-0.096-0.272   C52.314,31.257,51.201,30.694,50.014,30.694z M52.381,32.847h-4.734v-0.135c0.65-0.748,1.486-1.158,2.367-1.158   s1.717,0.41,2.367,1.158V32.847z">
                                </path>
                                <path
                                    d="M93.904,35.638l-22.881-1.486c-0.018-0.001-0.037-0.001-0.057-0.001H55.199v-3.449c0-0.061-0.008-0.12-0.018-0.176   c-0.111-0.798-0.576-4.21-0.729-6c-0.158-1.856-1.676-2.785-2.73-3.113l-0.891-2.779c-0.113-0.356-0.443-0.598-0.818-0.598l0,0   c-0.373,0-0.705,0.241-0.82,0.598l-0.887,2.773c-1.057,0.324-2.588,1.253-2.748,3.118c-0.152,1.787-0.614,5.18-0.727,5.997   c-0.012,0.058-0.018,0.118-0.018,0.179v3.449H29.031c-0.018,0-0.037,0-0.056,0.001L6.095,35.638   c-0.453,0.03-0.805,0.405-0.805,0.857v8.916c0,0.43,0.317,0.793,0.743,0.852l22.881,3.157c0.039,0.005,0.078,0.009,0.117,0.009   h15.875l2.369,20.886l-11.373,2.184c-0.405,0.078-0.698,0.432-0.698,0.846v5.992c0,0.426,0.311,0.787,0.73,0.85L47.92,82.02   c0.043,0.006,0.087,0.008,0.129,0.008c0.209,0,0.412-0.074,0.57-0.213l1.389-1.227l1.369,1.223c0.191,0.17,0.449,0.246,0.703,0.209   l11.984-1.834c0.42-0.063,0.73-0.424,0.73-0.85v-5.992c0-0.414-0.295-0.768-0.699-0.846l-11.359-2.18l2.371-20.89h15.859   c0.041,0,0.078-0.004,0.117-0.009l22.883-3.157c0.426-0.059,0.742-0.421,0.742-0.852v-8.916   C94.709,36.042,94.355,35.667,93.904,35.638z M92.988,44.661l-22.08,3.047H54.346c-0.004,0-0.008,0.001-0.012,0.001   c-0.43,0.001-0.801,0.324-0.85,0.763l-0.244,2.152c0-0.031,0-0.063,0-0.094c-0.023-1.546-0.912-1.959-1.436-1.959   c-0.006,0-0.012,0-0.016,0h-3.551c-0.004,0-0.011,0-0.016,0c-0.523,0-1.412,0.413-1.437,1.959   c-0.011,0.666,0.222,1.259,0.671,1.716c0.586,0.594,1.541,0.949,2.557,0.949s1.971-0.355,2.557-0.949   c0.314-0.32,0.521-0.709,0.615-1.141l-2.248,19.811c-0.049,0.422,0.219,0.807,0.613,0.922c0,0,0,0,0.002,0   c0.023,0.006,0.049,0.014,0.074,0.02c0.002,0,0.006,0.002,0.008,0.002l11.439,2.195v4.543l-10.855,1.66l-1.637-1.461   c-0.324-0.289-0.814-0.289-1.141-0.004l-1.658,1.465l-10.859-1.66v-4.543l11.458-2.199c0.441-0.086,0.744-0.496,0.693-0.941   l-2.547-22.443c-0.051-0.443-0.432-0.771-0.87-0.764c-0.002,0-0.004,0-0.006,0H29.091L7.01,44.661v-7.359l22.049-1.431h16.594   c0.003,0,0.007-0.001,0.011-0.001s0.006,0.001,0.01,0.001c0.476,0,0.859-0.386,0.859-0.86v-4.235   c0.108-0.78,0.582-4.258,0.74-6.104c0.104-1.203,1.384-1.585,1.688-1.658h0.014c0.414,0,0.76-0.292,0.842-0.682l0.197-0.616   l0.197,0.616c0.081,0.389,0.426,0.682,0.842,0.682c0.311,0.075,1.584,0.458,1.686,1.658c0.156,1.838,0.631,5.307,0.74,6.104v4.235   c0,0.474,0.387,0.86,0.861,0.86l0.002-0.001c0.002,0,0.002,0.001,0.004,0.001h16.596l22.047,1.431V44.661z M52.381,50.542   c0.008,0.438-0.137,0.807-0.424,1.1c-0.504,0.51-1.334,0.691-1.943,0.691c-0.61,0-1.441-0.182-1.943-0.691   c-0.289-0.293-0.432-0.662-0.424-1.1c0.016-1.045,0.492-1.108,0.57-1.11c0.006,0,0.004,0,0.014,0h3.564c0.01,0,0.01,0,0.016,0   C51.891,49.434,52.365,49.499,52.381,50.542z">
                                </path>
                            </g>
                        </svg>
                        fly<sup>3</sup>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ action('HomeController@profile') }}">
                                            Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')

    @if(config('app.env') == 'local')
        <script src="http://localhost:35729/livereload.js"></script>
    @endif
</body>
</html>
