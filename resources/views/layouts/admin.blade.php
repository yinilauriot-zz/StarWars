<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Star Wars - {{$title}}</title>
    <link rel="stylesheet" href="{{url('assets/css/Knacss.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/app.min.css')}}">
</head>
<body>
    <div class="wrapper">
        <header id="header" role="banner" class="line txtcenter">
            <h1 class="h1-like">Star Wars</h1>
            <nav id="navigation" role="navigation">
                <ul>
                    <li class="inbl"><a class="pas no-underline {{Request::is('/') ? 'current' : ''}}" href="{{url('/')}}">{{trans('app.public')}}</a></li>
                    @if (Auth::check())
                        <li class="inbl"><a class="pas no-underline {{Request::is('product') ? 'current' : ''}}" href="{{url('product')}}">Dashboard</a></li>
                        <li class="inbl"><a class="pas no-underline {{Request::is('history') ? 'current' : ''}}" href="{{url('history')}}">{{trans('app.history')}}</a></li>
                        <li class="inbl"><a class="pas no-underline {{Request::is('logout') ? 'current' : ''}}" href="{{url('logout')}}">Logout</a></li>
                    @else
                        <li class="inbl"><a class="pas no-underline" href="{{url('login')}}">Login</a></li>
                    @endif
                </ul>
            </nav>
        </header>

        <div id="main" role="main" class="line w960p">
            @yield('content')
        </div>
    </div>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="{{url('assets/js/jquery.min.js')}}"><\/script>')</script>
    <script src="{{url('assets/js/app.min.js')}}"></script>
</body>
</html>