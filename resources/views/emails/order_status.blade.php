@component('mail::message')
    Hi <b>{{ $order->name }}</b>,

    <p>Order Status :
        @if ($order->status == 0)
            Pending
        @elseif ($order->status == 1)
            InProgresse
        @elseif ($order->status == 2)
            Delivred
        @elseif ($order->status == 3)
            Completed
        @elseif ($order->status == 4)
            Canceled
        @endif
    </p>
@endcomponent
