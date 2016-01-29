@extends('layouts.master')

@section('content')
    @if (Session::has('message') || Session::has('messageEmpty'))
        @include('front.partials.flash')
    @endif

    <h6 class="h6-like cart">{{trans('app.cart')}}</h6>
    @if(!empty($carts))
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
                        <a class="inbl no-underline btn-cart" href="{{url('removeCart', $cart['id'])}}">
                            <i class="fa fa-trash-o"></i>
                        </a>
                    </td>
                    <td>
                        <select productId="{{$cart['id']}}" class="quantity" name="quantity" >
                            @for ($q=1; $q <= $cart['total_quantity']; $q++)
                                <option value="{{$q}}" {{($q == $cart['quantity'])? 'selected' : ''}}>{{$q}}</option>
                            @endfor
                        </select>
                    </td>
                    <td class="total_price{{$cart['id']}}">{{$cart['total_price']}} €</td>
                </tr>
            @endforeach
        </table>
        <div class="fr total">
            <p class="inbl">Total: <span id="total">{{$total}} €</span></p>
            <a class="validate" href="{{url('validateCart')}}">
                <button class="button">{{trans('app.validate')}}</button>
            </a>
        </div>
    @endif
@stop