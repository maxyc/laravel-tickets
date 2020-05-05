@extends('layouts.app')

@section('title', 'Orders list')

@section('content')
    <div class="container">
        <div class="row">

            @include('web.backend.sections.orders.filter')

            <table class="table table-bordered table-stripped table-hover">
                <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Messages</th>
                    <th>User</th>
                    <th>Create at</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($orders as $order)
                    <tr class="@if($order->isClosed()) text-muted table-secondary @elseif($order->isNew()) table-info @endif">
                        <td>

                            {{ $order->id }}

                        </td>
                        <td>
                            @if(!$order->is_read)<strong>@endif
                                <a href="{{ route('backend.orders.show', ['order'=>$order]) }}">{{ $order->title }}</a>
                                @if(!$order->is_read)</strong>@endif

                            @if($order->has_answer)<span class="text-danger">NEW</span>@endif
                        </td>
                        <td>{{ $order->status }}</td>
                        <td>{{ $order->count_messages }}</td>

                        <td>{{ $order->owner->name }} (#{{$order->owner_id}})</td>
                        <td>{{ $order->created_at }}</td>

                        <td>
                            @include('web.backend.sections.orders._partials.approve')
                            @include('web.backend.sections.orders._partials.close')
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $orders->links() }}

        <div class="card">
            <div class="card-header">Legend</div>
            <div class="card-body">

                <p><span class="text-info">Blue row</span> - new orders</p>
                <p><span class="">Default</span> - approved orders</p>
                <p><span class="text-secondary">Gray row</span> - closed orders</p>
                <p><strong>strong</strong> - unread message</p>
                <p><span class="text-danger">NEW</span> - has new unread messages</p>
            </div>
        </div>
    </div>
@endsection
