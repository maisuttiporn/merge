<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" />

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery3.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-4.6.2-dist/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('plugins/bootstrap-datepicker-1.9.0-dist/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datepicker-1.9.0-dist/locales/bootstrap-datepicker.th.min.js') }}"
        charset="UTF-8"></script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Kanit" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker.min.css') }}"
        rel="stylesheet">


    {{--
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,200;0,300;0,400;1,200;1,300;1,400&display=swap"
        rel="stylesheet"> --}}

    <style>
        body {
            font-family: Kanit;
        }

        a:link,
        a:visited,
        a:hover,
        a:active {
            text-decoration: none;
        }

        table {
            font-size: 16px;
        }

        .table th,
        .table td {
            padding: 5px;
        }


        .outerDivFull {
            margin: 50px;
        }

        .switchToggle input[type=checkbox] {
            height: 0;
            width: 0;
            visibility: hidden;
            position: absolute;
        }

        .switchToggle label {
            cursor: pointer;
            text-indent: -9999px;
            width: 70px;
            max-width: 70px;
            height: 30px;
            background: #d1d1d1;
            display: block;
            border-radius: 100px;
            position: relative;
        }

        .switchToggle label:after {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            width: 26px;
            height: 26px;
            background: #fff;
            border-radius: 90px;
            transition: 0.3s;
        }

        .switchToggle input:checked+label,
        .switchToggle input:checked+input+label {
            /* background: #3e98d3; */
            background:  #ff9800;
        }

        .switchToggle input+label:before,
        .switchToggle input+input+label:before {
            content: 'No';
            position: absolute;
            top: 5px;
            left: 35px;
            width: 26px;
            height: 26px;
            border-radius: 90px;
            transition: 0.3s;
            text-indent: 0;
            color: #fff;
        }

        .switchToggle input:checked+label:before,
        .switchToggle input:checked+input+label:before {
            content: 'Yes';
            position: absolute;
            top: 5px;
            left: 10px;
            width: 26px;
            height: 26px;
            border-radius: 90px;
            transition: 0.3s;
            text-indent: 0;
            color: #fff;
        }

        .switchToggle input:checked+label:after,
        .switchToggle input:checked+input+label:after {
            left: calc(100% - 2px);
            transform: translateX(-100%);
        }

        .switchToggle label:active:after {
            width: 60px;
        }

        .toggle-switchArea {
            margin: 10px 0 10px 0;
        }

        .btn-orange {
            color: #fff;
            background-color: #FF9800;
            border-color: #FFC107;
        }

        .btn:hover {
            color: #e5d1bbff;
            text-decoration: none;
        }

       .text-orange {
            color: #ff9800;
       }
    </style>
    @yield('js')
</head>

<body>
    @include('sweetalert::alert')
    <div id="app">

        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4  bg-white border-bottom shadow-sm">
            <h5 class="my-0 mr-md-auto font-weight-normal">
                <a href="{{ route('main') }}">
                    <img width="36" src="{{ asset('img/logo.png') }}">
                    <strong class="text-dark">{{ config('app.name', 'Laravel') }}</strong></a>
            </h5>
            <nav class="my-2 my-md-0 mr-md-3 font-weight-bold">
                <a class="p-2 text-dark" href="{{ route('inv.index') }}">
                    <i class="fa-solid fa-vault"></i>
                    ตู้แก๊ง</a>
                <a class="p-2 text-dark" href="{{ route('checkin.check') }}">
                    <i class="fa-solid fa-list-check"></i>
                    เช็คชื่อ</a>
                <a class="p-2 text-dark" href="{{ route('checkin.index') }}">
                    <i class="fa-regular fa-calendar-check"></i>
                    กิจกรรม</a>
                <a class="p-2 text-dark" href="{{ route('payment.index') }}">
                    <i class="fa-solid fa-sack-dollar"></i>
                    เคลียร์ตัง</a>
                <a class="p-2 text-dark" href="{{ route('user.index') }}">
                    <i class="fa-solid fa-users"></i>
                    สมาชิก</a>

            </nav>
            @guest
                <!-- <a class="btn btn-outline-primary" href="">ลงชื่อเข้าใช้</a> -->
            @endguest
            @auth
                <strong>Welcome K.{{ Auth::user()->name }} &nbsp; </strong>
                <a href="" class="btn btn-outline-primary" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    Logout
                </a>


            @endauth


        </div>
        <form id="logout-form" action="" method="POST" style="display: none;">
            @csrf
        </form>

        <!-- <div class="switchToggle">
                <input type="checkbox" id="switch">
                <label for="switch">Toggle</label>
            </div> -->



        @yield('content')




    </div>


    @yield('js')



</body>


</html>