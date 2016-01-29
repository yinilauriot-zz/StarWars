@extends('layouts.master')

@section('content')
    @if (Session::has('messageFail'))
        @include('front.partials.flash')
    @endif
    <h5 class="h5-like">{{trans('app.payment')}}</h5>
    <form method="POST" action="{{url('payment')}}">
        {!! csrf_field() !!}
        <div class="form-text">
            <label class="label" for="name">{{trans('app.name')}}</label><br>
            <input class="input-text" id="name" name="name" type="text" value="{{old('name')}}"><br>
            @if ($errors->has('name'))
                <span class="error">{{$errors->first('name')}}</span>
            @endif
        </div>
        <div class="form-text">
            <label class="label" for="cardNumber">{{trans('app.cardNumber')}}</label><br>
            <input class="input-text" id="cardNumber" name="cardNumber" type="text" value="{{old('cardNumber')}}"><br>
            @if ($errors->has('cardNumber'))
                <span class="error">{{$errors->first('cardNumber')}}</span>
            @endif
        </div>
        <input type="hidden" name="command_id" value="{{$command_id}}">
        <div class="form-submit">
            <input class="button" type="submit" value="{{trans('app.pay')}}"><br>
        </div>
    </form>
@stop