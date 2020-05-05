@extends('layouts.app')

@section('title', $order->title)

@section('content')
    <div class="container">
        <div class="row">

            <div
                class="card @if($order->isNew()) bg-info text-white @elseif($order->isApproved()) bg-light @else bg-secondary text-white @endif mb-3 w-100">
                <div class="card-header">Order #{{ $order->id }}</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $order->title }}</h5>
                    <p class="card-text">{{ $order->note }}</p>
                </div>
                <div class="card-footer">
                    <dl class="row">
                        <dt class="col-sm-2">Owner:</dt>
                        <dd class="col-sm-10">{{ $order->owner->name }} (#{{ $order->owner_id }})</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-2">Status:</dt>
                        <dd class="col-sm-10">{{ $order->status }}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-2">Last update at:</dt>
                        <dd class="col-sm-10">{{ $order->updated_at }}</dd>
                    </dl>
                    <dl class="row">
                        <dt class="col-sm-2">Available actions:</dt>
                        <dd class="col-sm-10">
                            @include('web.frontend.sections.orders._partials.close')
                        </dd>
                    </dl>
                </div>
            </div>

            @include('web.frontend.sections.orders.form_answer')

            <h3>
                Messages ({{ $order->countMessages }})
                <small class="text-muted">Bottom older</small>
            </h3>


            @foreach($order->messages as $message)
                <div class="card w-100 mb-3 @if($message->owner_id === Auth::user()->id) text-right @endif">
                    <div class="card-header">From <strong>{{ $message->owner->name }}</strong>
                        at {{ $message->created_at }}</div>
                    <div class="card-body">
                        {{ $message->text }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
