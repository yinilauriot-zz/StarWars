@extends('layouts.master')

@section('content')
<div class="area">
    <h5 class="h5-like">{{trans('app.myContact')}}</h5>
    <p>{{trans('app.name')}}
        <span>{{$user->name}}</span>
    </p>
    <p>{{trans('app.emailAddress')}}
        <span>{{$user->email}}</span>
    </p>
    <p>{{trans('app.address')}}
        <span>{{$customer->address}}</span>
    </p>
    <p>{{trans('app.cardNumber')}}
        <span>{{$customer->number_card}}</span>
    </p>
</div>
<hr></hr>
<div class="area">
    <h5 class="h5-like">{{trans('app.myCommand')}}</h5>
    <table>
        <tr>
            <th>{{trans('app.command_id')}}</th>
            <th>{{trans('app.command_at')}}</th>
            <th>{{trans('app.command_product')}}</th>
            <th>{{trans('app.total_price')}}</th>
            <th>{{trans('app.command_status')}}</th>
        </tr>
        @forelse($histories as $history)
            <tr>
                <td>{{$history->command_id}}</td>
                <td>{{$history->command_at}}</td>
                <td><a href="{{url('prod', [$history->product->id, $history->product->slug])}}">{{$history->product->name}}</a></td>
                <td>{{$history->price}} €</td>
                <td>{{$history->status}}</td>
            </tr>
        @empty
            <p>No product</p>
        @endforelse
    </table>
</div>
{!! $histories->links() !!}
@stop