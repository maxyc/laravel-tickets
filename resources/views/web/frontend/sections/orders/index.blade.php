@extends('layouts.app')

@section('title', 'Orders list')

@section('content')
    <div class="container">
        <div class="row">

            @can('create_order', Auth::user())
            <a href="{{ route('frontend.orders.create') }}" class="btn btn-primary btn-sm">Create new order</a>
            @endcan

            <table class="table table-bordered table-stripped table-hover">
                <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Messages</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($models as $model)
                    <tr class="@if($model->isClosed()) text-muted table-secondary @elseif($model->isNew()) table-info @endif">
                        <td>

                            {{ $model->id }}

                        </td>
                        <td>
                            @if(!$model->is_read)<strong>@endif
                                <a href="{{ route('frontend.orders.show', ['order'=>$model]) }}">{{ $model->title }}</a>
                                @if(!$model->is_read)</strong>@endif

                            @if($model->has_answer)<span class="text-danger">NEW</span>@endif
                        </td>
                        <td>{{ $model->status }}</td>
                        <td>{{ $model->count_messages }}</td>
                        <td>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        {{ $models->links() }}

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
