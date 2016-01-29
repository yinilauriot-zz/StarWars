<nav id="navigation" role="navigation" class="wrapper">
    <ul>
        <li class="inbl"><a class="pas no-underline {{Request::is('/') ? 'current' : ''}}" href="{{url('/')}}">{{trans('app.home')}}</a></li>
        @forelse ($categories as $id => $title)
            <li class="inbl"><a class="pas no-underline {{Request::is('cat/'.$id.'/'.str_slug($title)) ? 'current' : ''}}" href="{{url('cat', [$id, str_slug($title)])}}">{{$title}}</a></li>
        @empty
            <li>{{trans('app.noCategory')}}</li>
        @endforelse
        <li class="inbl"><a class="pas no-underline {{Request::is('contact') ? 'current' : ''}}" href="{{url('contact')}}">Contact</a></li>
        @if (Auth::check())
            @if(Auth::user()->role == 'administrator' || Auth::user()->role == 'editor')
                <li class="inbl"><a class="pas no-underline {{Request::is('product') ? 'current' : ''}}" href="{{url('product')}}">Dashboard</a></li>
            @endif
            <li class="inbl"><a class="pas no-underline {{Request::is('account') ? 'current' : ''}}" href="{{url('account')}}">{{trans('app.account')}}</a></li>
            <li class="inbl"><a class="pas no-underline {{Request::is('logout') ? 'current' : ''}}" href="{{url('logout')}}">Logout</a></li>
        @else
            <li class="inbl"><a class="pas no-underline {{Request::is('login') ? 'current' : ''}}" href="{{url('login')}}">Login</a></li>
        @endif
        <li class="inbl">
            <a class="pas no-underline logo-cart" href="{{url('cart')}}">
                <i class="fa fa-shopping-cart"></i>
                <span class="inbl" @if(count(Session::get('cart')) == 0) style="display: none;" @endif>@if(count(Session::get('cart')) > 0) {{count(Session::get('cart'))}} @endif</span>
            </a>
        </li>
    </ul>
</nav>