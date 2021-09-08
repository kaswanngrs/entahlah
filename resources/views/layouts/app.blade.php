<!doctype html>


<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sayd Austora') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>
    {{-- <script src="{{ asset('js/dashbord.js') }}" defer></script> --}}
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('dashbord/style.css') }}" rel="stylesheet">

    <style>
        .nav-class {

            /* background-image: linear-gradient(326deg, #cecebf, #c6c1dc, #635e79, #4c4b50); */
            color: #000;
            background: #fff;
        }

        body {

            background-color: #f7fafc;
            font-family: cursive;
        }

        li {
            margin-bottom: 10px;
        }

        .cool-link {
            display: inline-block;
            color: #000;
            text-decoration: none;
        }

        .cool-link::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #635e79;
            transition: width .10s;
        }

        .cool-link:hover::after {
            width: 100%;
            transition: width .5s;
        }

        #accordian {
            width: 250px;
            padding: 10px;
            float: left;
            height: 100vh;


            -webkit-animation-duration: 500ms;
            animation-duration: 500ms;

            -webkit-animation-duration: 1000ms;
            animation-duration: 1000ms;
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;

            width: 16rem;

            position: relative;

            padding: 1.5rem;


            display: flex;

            border-right-width: 1px;
            background-color: #fff;

        }
    input[type=text] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    input[type=submit] {
      width: 100%;
      background-color: #007bff;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type=submit]:hover {
      background-color: #007bff;
    }

    textarea {
  width: 100%;
  height: 150px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}
    </style>


</head>
<body>
    <div id="app">
        <main class="___class_+?0___">
            <div class="flash-message ">

                @if (Session::has('error'))
                    <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif
                @if (Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                @endif
            </div>
            <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-lg nav-class ">
                <div class="container">
                    <a class="navbar-brand text-white">


                        <img src="{{ asset('/icons/logo.png') }}" class="rounded" alt="..." style="width: 5%;">
                        Sayd Aostra icons
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                        </ul>
                        <ul class="navbar-nav ml-auto ">
                            @guest
                                <li class="nav-item ">
                                    <a class="nav-link  " href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#"
                                        role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                        v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item " href="{{ route('logout') }}" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>
        </main>
        @auth
            <div class="row">
                <div id="accordian"
                    class="col-3 relative flex flex-col flex-wrap bg-white border-r border-gray-300 p-6 flex-none w-64 md:-ml-64 md:fixed md:top-0 md:z-30 md:h-screen md:shadow-xl animated faster">
                    <ul class="show-dropdown text-left">
                        <li>
                            <a href="{{ url('home') }}" class="cool-link"><i
                                    class="fas fa-tachometer-alt"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ url('users') }}" class="cool-link"><i
                                    class="far fa-address-book"></i>Users</a>
                        </li>
                        <li>
                            <a href="{{ url('questions') }}" class="cool-link"><i
                                    class="far fa-address-book"></i>Questions & Answers</a>
                        </li>

                        <li>
                            <a href="{{ url('games') }}" class="cool-link"><i
                                    class="far fa-address-book"></i>Games</a>
                        </li>

                        <li>
                            <a href="{{ url('/notifction/create') }}" class="cool-link"><i
                                    class="far fa-address-book"></i>Notifcation</a>
                        </li>


                        <li>
                            <a href="{{ route('show') }}" class="cool-link"><i
                                    class="far fa-address-book"></i>Tasks</a>
                        </li>

                        <li>
                            <a href="{{ route('show.awards') }}" class="cool-link"><i
                                    class="far fa-address-book"></i>Awards</a>
                        </li>

                        <li>
                            <a href="{{ route('request') }}" class="cool-link"><i
                                    class="far fa-address-book"></i>Request</a>
                        </li>
                    </ul>
                </div>
            @endauth
            <div class=" col-9 ">
                @yield('content')
            </div>
        </div>
    </div>

</body>

</html>
