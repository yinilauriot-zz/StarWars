@extends('layouts.master')

@section('content')
    <form method="POST" action="{{url('storeCart')}}">
        {{ csrf_field() }}
        <div class="product clearfix">
            @if ($picture = $product->picture)
                <img class="fl" src="{{url('uploads', $picture->uri)}}">
            @endif
            <input class="input-text" name="product_id" type="hidden" value="{{$product->id}}">
            <input class="input-text" id="price" type="hidden" value="{{$product->price}}">
            <h5 class="name h5-like">{{$product->name}}<em class="fr name h5-like">{{$product->price}}€</em></h5>
            <p class="description mam">{{$product->content}}</p>
            @include('front.partials.meta', compact('product'))
            <div class="form-text">
                <label class="label" for="quantity">{{trans('app.quantity')}}: </label>
                @if ($product->quantity > 0)
                    <select name="quantity" id="quantity-bloc">
                        @for ($quantity=1; $quantity <= $product->quantity; $quantity++)
                            <option value="{{$quantity}}">{{$quantity}}</option>
                        @endfor
                    </select>
                    <div class="form-submit">
                        <a class="inbl fl" href="{{url('/')}}">
                            <input class="button" type="submit" value="{{trans('app.command')}}">
                        </a>
                    </div>
                @else
                    <span class="inbl">Indispobile</span>
                @endif
            </div>
        </div>
    </form>

    <h5 class="h5-like best">{{trans('app.bestSeller')}}</h5>
    @foreach($bests as $best)
        <div class="product fl best-prod">
            @if ($picture = $best->picture)
                <div class="clearfix">
                <a href="{{url('prod', [$best->id, $best->slug])}}"><img class="fl" src="{{url('uploads', $picture->uri)}}" width="150" height="150"></a>
                </div>
            @endif
            <h6 class="name h6-like"><a class="no-underline" href="{{url('prod', [$best->id, $best->slug])}}">{{$best->name}}</a></h6>
            @if($title != "Product {$best->name}")
                <p>{{trans('app.price')}}: {{$best->price}}€</p>
            @endif
            <p>{{trans('app.tag')}}:
                @forelse($best->tags as $tag)
                    <a href="{{url('tag', [$tag->id, str_slug($tag->name)])}}">{{$tag->name}}</a>
                @empty
                    {{trans('app.noTag')}}
                @endforelse
            </p>
            @if($category = $best->category)
                <p>{{trans('app.category')}}: <a class="category" href="{{url('cat', [$category->id, str_slug($category->title)])}}">{{$category->title}}</a></p>
            @else
                <p>{{trans('app.noCategory')}}</p>
            @endif
        </div>
    @endforeach
@stop