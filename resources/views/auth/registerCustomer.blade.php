@extends('layouts.master')

@section('content')
    <h5 class="h5-like">{{trans('app.registerCustomer')}}</h5>
    <form method="POST" action="{{url('storeCustomer')}}">
        {!! csrf_field() !!}
        <div class="form-text">
            <label class="label" for="address">{{trans('app.address')}}</label><br>
            <input class="input-text" id="address" name="address" type="text" value="{{old('address')}}"><br>
            @if ($errors->has('address'))
                <span class="error">{{$errors->first('address')}}</span>
            @endif
        </div>
        <div class="form-text">
            <label class="label" for="number_card">{{trans('app.cardNumber')}}</label><br>
            <input class="input-text" id="number_card" name="number_card" type="text" value="{{old('number_card')}}"><br>
            @if ($errors->has('number_card'))
                <span class="error">{{$errors->first('number_card')}}</span>
            @endif
        </div>
        <div class="form-submit inbl">
            <input class="button" type="submit" value="{{trans('app.update')}}">
        </div>
    </form>
@stop