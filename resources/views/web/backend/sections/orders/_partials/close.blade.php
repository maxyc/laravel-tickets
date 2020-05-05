@can('close', $order)
    <form class="d-inline-block" method="post" onsubmit="return confirm('Are you sure?')"
          action="{{ route('backend.orders.close', ['order'=>$order])}}">
        @csrf
        @method('PATCH')

        <button class="btn btn-danger btn-sm" type="submit" data-toggle="tooltip"
                data-placement="bottom" title="Close order"> Close
        </button>
    </form>
@endcan
