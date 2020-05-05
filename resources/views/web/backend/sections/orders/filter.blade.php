<div class="card">
    <div class="card-body">
        <form action="{{ URL::current() }}" class="form-inline">
            <label for="status">Status</label>
            <select name="status" class="form-control mb-2 mr-sm-2" id="status" onchange="this.form.submit()">
                    <option value="">Choose...</option>
                @foreach($availableStatuses as $key=>$value)
                    <option @if(request('status') === $key) selected @endif value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </form>
    </div>
</div>
