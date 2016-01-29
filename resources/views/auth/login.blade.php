@extends('layouts.master')

@section('content')
    @if (Session::has('message'))
        @include('front.partials.flash')
    @else
    <h6 class="h6-like contact">Login</h6>
    <form method="POST" action="{{url('login')}}">
        {!! csrf_field() !!}
        <div class="form-text">
            <label class="label" for="email">{{trans('app.emailAddress')}}</label><br>
            <input class="input-text" id="email" name="email" type="email" value="{{old('email')}}"><br>
            @if ($errors->has('email'))
                <span class="error">{{$errors->first('email')}}</span>
            @endif
        </div>
        <div class="form-text">
            <label class="label" for="password">{{trans('app.password')}}</label><br>
            <input class="input-text" id="password" name="password" type="password"><br>
            @if ($errors->has('password'))
                <span class="error">{{$errors->first('password')}}</span>
            @endif
        </div>
        <div class="form-text">
            <input class="input-text" id="remember" name="remember" type="radio" value="true">
            <label class="label" for="remember">{{trans('app.remember')}}</label>
        </div>
        <div class="form-submit">
            <input class="button" type="submit" value="Login">
        </div>
    </form>
    @endif
@stop