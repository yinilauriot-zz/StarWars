@extends('layouts.admin')

@section('content')
    {!! $histories->links() !!}
    <table>
        <tr>
            <th>{{trans('app.command_id')}}</th>
            <th>{{trans('app.command_at')}}</th>
            <th>{{trans('app.username')}}</th>
            <th>{{trans('app.command_product')}}</th>
            <th>{{trans('app.total_price')}}</th>
            <th>{{trans('app.command_status')}}</th>
        </tr>
        @forelse($histories as $history)
            <tr>
                <td>{{$history->command_id}}</td>
                <td>{{$history->command_at}}</td>
                <td>{{$history->customer->user->name}}</td>
                <td><a href="{{url('product', $history->product->id)}}">{{$history->product->name}}</a></td>
                <td>{{$history->price}}</td>
                <td>{{$history->status}}</td>
            </tr>
        @empty
            <p>No product</p>
        @endforelse
    </table>
    {!! $histories->links() !!}
@stop