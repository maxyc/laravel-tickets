@can('approve', $order)
    <form class="d-inline-block" method="post"
          action="{{ route('backend.orders.approve', ['order'=>$order])}}">
        @csrf
        @method('PATCH')

        <button class="btn btn-success btn-sm" type="submit" data-toggle="tooltip"
                data-placement="bottom" title="Approve order"> Approve
        </button>
    </form>
@endcan
