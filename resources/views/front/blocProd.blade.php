@forelse($products as $product)
    <div class="product clearfix">
        @if ($picture = $product->picture)
            <a href="{{url('prod', [$product->id, $product->slug])}}"><img class="fl" src="{{url('uploads', $picture->uri)}}" width="250" height="250"></a>
        @endif
        <h6 class="name h6-like"><a class="no-underline" href="{{url('prod', [$product->id, $product->slug])}}">{{$product->name}}</a></h6>
        <p class="description">{{$product->abstract}}</p>
        @include('front.partials.meta', compact('product'))
    </div>
@empty
    <p>No product</p>
@endforelse
<input type="hidden" name="lastPage" id="lastPage" value="{{ $lastPage }}" />
{{--{!! $products->links() !!}--}}
