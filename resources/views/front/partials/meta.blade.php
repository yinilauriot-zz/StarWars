@if($title != "Product {$product->name}")
    <p>{{trans('app.price')}}: {{$product->price}}€</p>
@endif
<p>{{trans('app.tag')}}:
    @forelse($product->tags as $tag)
        <a href="{{url('tag', [$tag->id, str_slug($tag->name)])}}">{{$tag->name}}</a>
    @empty
        {{trans('app.noTag')}}
    @endforelse
</p>
@if($category = $product->category)
    <p>{{trans('app.category')}}: <a class="category" href="{{url('cat', [$category->id, str_slug($category->title)])}}">{{$category->title}}</a></p>
@else
    <p>{{trans('app.noCategory')}}</p>
@endif
<p>{{trans('app.published_at')}}: {{$product->published_at}}</p>