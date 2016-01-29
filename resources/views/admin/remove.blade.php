@extends('layouts.admin')

@section('content')
    <p class="confirm">{{trans('app.confirm_remove')}}</p>
    <form class="inbl" method="POST" action="{{url('product', $product->id)}}">  {{-- connecter à la méthode delete --}}
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        {{--<input type="hidden" name="_method" value="delete">--}}
        <input class="button" type="submit" value="{{trans('app.remove')}}">
    </form>
    <a href="{{url('product')}}"><button class="button btn-cancel">{{trans('app.cancel')}}</button></a>
@stop