<!doctype html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>Star Wars - {{$title}}</title>
        <link rel="stylesheet" href="{{url('assets/css/Knacss.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/app.min.css')}}">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{url('assets/css/font-awesome.min.css')}}">
    </head>
    <body>
        <header id="header" role="banner" class="line txtcenter clearfix">
            <h1 class="h1-like fl"><img src="http://localhost:8000/assets/img/logo.jpg" alt="Star Wars Logo"></h1>
            @include('partials.nav')
        </header>

        <div class="wrapper">
            <div id="main" role="main" class="line w960p">
                @yield('content')
            </div>
            <footer id="footer" role="contentinfo" class="line txtcenter">
                <nav id="navigation" class="line">
                    <ul class="">
                        <li class="inbl"><a class="pas no-underline" href="{{url('/')}}">{{trans('app.home')}}</a></li>
                        <li class="inbl"><a class="pas no-underline" href="{{url('mentions')}}">Mentions</a></li>
                        <li class="inbl"><a class="pas no-underline" href="{{url('contact')}}">Contact</a></li>
                    </ul>
                </nav>
            </footer>
        </div>

        <?php
        $encryp = app('Illuminate\Encryption\Encrypter');
        $encryp_token = $encryp->encrypt(csrf_token());
        ?>
        <input type="hidden" name="token" id="token" value="{{ $encryp_token }}" />

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="{{url('assets/js/jquery.min.js')}}"><\/script>')</script>
        <script src="{{url('assets/js/app.min.js')}}"></script>
    </body>
</html>