@can('answer', $order)
<div class="card w-100">
    <form action="{{ route('backend.orders.answer', ['order'=>$order]) }}" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="text">Answer</label>
                <textarea required class="form-control @error('text') is-invalid @enderror" id="text" name="text">{{ old('text') }}</textarea>
                @error('text')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Send answer</button>
        </div>
    </form>
</div>
@endcan
