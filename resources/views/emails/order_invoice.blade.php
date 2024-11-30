<!DOCTYPE html>
<html lang="en">

<head>
    @component('mail::message')
    </head>

    <body>
        <div class="container">
            <h1>Invoice</h1>
            <p>Thank you for your order!</p>
            <p><strong>Order Number:</strong> {{ $order->order_number }} </p>
            <p><strong>Date:</strong> {{ $order->created_at }}</p>

            <h2>Billing Information</h2>
            <p><strong>Name:</strong> {{ $order->first_name }} </p>
            <p><strong>Email:</strong> {{ $order->email }}</p>


            <h2>Order Details</h2>
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->getItem as $item)
                        <tr>
                            <td>{{ $item->getProduct->title }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->color_name }}</td>
                            @if (!empty($item->size_name))
                                <td>{{ $item->size_name }}</td>
                                <td>{{ $item->size_amount }}</td>
                            @endif
                            <td>${{ number_format($item->total_pice, 2) }}</td>
                        </tr>
                    @endforeach
                    <p><strong>Shipping name:</strong> {{ $order->shipping_name }}</p>
                    <p><strong>Shipping amount:</strong> {{ $order->shipping_amount }}</p>
                    @if (!empty($order->discount_code))
                        <p><strong>Discount Code:</strong> {{ $order->discount_code }}</p>
                        <p><strong>Discount amount:</strong> {{ $order->discount_amount }}</p>
                    @endif
                    <p><strong>Total amount:</strong> {{ $order->total_amount }}</p>


                </tbody>
            </table>

            <p class="total">Total: {{ number_format($order->total_amount, 2) }}</p>

            <div class="footer">
                <p>If you have any questions about your order, feel free to contact us at support@example.com.</p>
                <p>Thank you for shopping with us!</p>
            </div>
        </div>

    </body>

    Thanks,
@endcomponent
