@extends('layouts.master')

@section('content')
    <h5 class="h5-like">{{trans('app.register')}}</h5>
    <form method="POST" action="{{url('storeUser')}}">
        {!! csrf_field() !!}
        <div class="form-text">
            <label class="label" for="name">{{trans('app.name')}}</label><br>
            <input class="input-text" id="name" name="name" type="text" value="{{old('name')}}"><br>
            @if ($errors->has('name'))
                <span class="error">{{$errors->first('name')}}</span>
            @endif
        </div>
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
            <label class="label" for="password_confirmation">{{trans('app.confirmPassword')}}</label><br>
            <input class="input-text" id="password_confirmation" name="password_confirmation" type="password"><br>
            @if ($errors->has('password_confirmation'))
                <span class="error">{{$errors->first('password_confirmation')}}</span>
            @endif
        </div>
        <div class="form-submit inbl">
            <input class="button" type="submit" value="{{trans('app.register')}}">
        </div>
    </form>
@stop