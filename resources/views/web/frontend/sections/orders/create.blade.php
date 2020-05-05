@extends('layouts.app')

@section('title', 'Create order')

@section('content')
    <div class="container">
        <div class="row">

            @can('create_order', Auth::user())
                <div class="card w-100">
                    <div class="card-header">Create new order</div>
                    <form action="{{ route('frontend.orders.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" required class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                                @error('title')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="text">Text</label>
                                <textarea required class="form-control @error('note') is-invalid @enderror" id="text" name="note">{{ old('note') }}</textarea>
                                @error('note')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="text">File</label>
                                <div class="custom-file">
                                    <input name="file" type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                @error('note')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary">Create order</button>
                            <br/>
                            <small class="text-muted">You may create new order 1 times at 1 day!</small>
                        </div>
                    </form>
                </div>
            @endcan


        </div>
    </div>
@endsection
