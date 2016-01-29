@extends('layouts.master')

@section('content')
    @if (Session::has('message'))
        @include('front.partials.flash')
    @endif
    <div id="scroll">
        @include('front.blocProd')
    </div>

    <div id="loader"><img src="assets/img/ajax-loader.gif"></div>
@stop
