<div class="card w-100">
    <form action="{{ route('frontend.orders.answer', ['order'=>$order]) }}" method="post">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="text">Answer</label>
                <textarea class="form-control" id="text" name="text">{{ old('text') }}</textarea>
            </div>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary">Send answer</button>
        </div>
    </form>
</div>
