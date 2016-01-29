@extends('layouts.admin')

@section('content')
    @if (Session::has('message'))
        @include('front.partials.flash')
    @endif

    <a href="{{url('product', 'create')}}"><button class="button">{{trans('app.create')}}</button></a>   {{-- url('product', 'create') égale à url('product/create') --}}
    {!! $products->links() !!}
    <table>
        <tr>
            <th>{{trans('app.status')}}</th>
            <th>{{trans('app.prodName')}}</th>
            <th>{{trans('app.price')}}</th>
            <th>{{trans('app.quantity')}}</th>
            <th>{{trans('app.published_at')}}</th>
            <th>{{trans('app.category')}}</th>
            <th>{{trans('app.tag')}}</th>
            @if(Auth::user()->role == 'administrator')
                <th>Action</th>
            @endif
        </tr>
        @forelse($products as $product)
            <tr>
                <td><a href="{{url('product', ['status', $product->id])}}"><button class="button btn-{{$product->status}}">{{$product->status}}</button></a></td>
                <td><a href="{{url('product', [$product->id, 'edit'])}}">{{$product->name}}</a></td>
                <td>{{$product->price}} €</td>
                <td>{{$product->quantity}}</td>
                <td>{{$product->published_at}}</td>
                <td>{{(!empty($product->category))? $product->category->title : trans('app.noCategory')}}</td>
                <td>
                    @forelse($product->tags as $tag)
                        {{$tag->name}}
                    @empty
                        {{trans('app.noTag')}}
                    @endforelse
                </td>
                @if(Auth::user()->role == 'administrator')
                    <td><a href="{{url('product', ['remove', $product->id])}}"><button class="button">{{trans('app.remove')}}</button></a></td>
                @endif
            </tr>
        @empty
            <p>No product</p>
        @endforelse
    </table>
    {!! $products->links() !!}
@stop

