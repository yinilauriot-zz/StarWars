@extends('layouts.master')

@section('content')
    @forelse($products as $product)
        <div class="product clearfix">
            @if ($picture = $product->picture)
                <img class="fl" src="{{url('uploads', $picture->uri)}}" width="230" height="147">
            @endif
            <h6 class="name h6-like"><a class="no-underline" href="{{url('prod', [$product->id, $product->slug])}}">{{$product->name}}</a></h6>
            <p class="description">{{$product->abstract}}</p>
            @include('front.partials.meta', compact('product'))
        </div>
    @empty
        <p>No product</p>
    @endforelse
    {!! $products->links() !!}
@stop
