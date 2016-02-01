@extends('layouts.master')

@section('content')
    @if (Session::has('message'))
        @include('front.partials.flash')
    @endif
    @if(Auth::check() && !empty($carts))
        <h6 class="h6-like cart">{{trans('app.confirmCart')}}</h6>
        <table>
            <tr>
                <th>{{trans('app.product')}}</th>
                <th>{{trans('app.quantity')}}</th>
                <th>{{trans('app.price')}}</th>
            </tr>
            @foreach($carts as $cart)
                <tr>
                    <td>
                        <figure>
                            <a href="{{url('prod', [$cart['id'], $cart['slug']])}}"><img src="{{url('uploads', $cart['picture'])}}" width="100" height="100"></a>
                            <figcaption>
                                <a class="no-underline inbl cart-name" href="{{url('prod', [$cart['id'], $cart['slug']])}}">{{$cart['name']}}</a>
                            </figcaption>
                        </figure>
                    </td>
                    <td>{{$cart['quantity']}}</td>
                    <td>{{$cart['total_price']}} €</td>
                </tr>
            @endforeach
        </table>
        <div class="fr total">
            <p class="inbl">Total: <span id="total">{{$total}} €</span></p>
            <a class="validate" href="{{url('confirmCart')}}">
                <button class="button">{{trans('app.finish')}}</button>
            </a>
        </div>
    @endif
@stop