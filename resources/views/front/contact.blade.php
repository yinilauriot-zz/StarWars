@extends('layouts.master')

@section('content')
    @if (Session::has('message'))
        @include('front.partials.flash')
    @endif

    <h6 class="h6-like contact">Contact</h6>
    <form method="POST" action="{{url('storeContact')}}">
        {{ csrf_field() }}
        <div class="form-text">
            <label class="label" for="email">{{trans('app.emailAddress')}}</label><br>
            <input class="input-text" id="email" name="email" type="text" value="{{old('email')}}"><br>
            @if ($errors->has('email'))
                <span class="error">{{$errors->first('email')}}</span>
            @endif
            {{-- {{$errors->has('email') ? $errors->first('email') : ''}} --}}
        </div>
        <div class="content">
            <label class="label" for="content">{{trans('app.messageContact')}}</label><br>
            <textarea class="text-area" cols="30" rows="5" name="content">{{old('content')}}</textarea><br>
            @if ($errors->has('content'))
                <span class="error">{{$errors->first('content')}}</span>
            @endif
        </div>
        <div class="form-submit">
            <input class="button" type="submit" value="Envoyer">
        </div>
    </form>
@stop