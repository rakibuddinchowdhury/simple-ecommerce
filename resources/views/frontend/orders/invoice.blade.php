<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: sans-serif; padding: 20px; }
        .header { width: 100%; border-bottom: 2px solid #ddd; padding-bottom: 20px; margin-bottom: 20px; }
        .logo { font-size: 24px; font-weight: bold; color: #1E40AF; }
        .invoice-details { float: right; text-align: right; }
        .billing-info { margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total-section { float: right; margin-top: 20px; width: 300px; }
        .total-row { display: flex; justify-content: space-between; font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <span class="logo">MyShop.</span>
        <div class="invoice-details">
            <strong>Invoice #{{ $order->id }}</strong><br>
            Date: {{ $order->created_at->format('d-m-Y') }}<br>
            Tracking: {{ $order->tracking_no }}
        </div>
    </div>

    <div class="billing-info">
        <h3>Billing Details:</h3>
        Name: {{ $order->fullname }}<br>
        Email: {{ $order->user->email }}<br>
        Phone: {{ $order->phone }}<br>
        Address: {{ $order->address }}, {{ $order->city }} - {{ $order->zipcode }}
    </div>

    <h3>Order Items</h3>
    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @foreach($order->orderItems as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>${{ $item->price }}</td>
                <td>{{ $item->qty }}</td>
                <td>${{ $item->price * $item->qty }}</td>
            </tr>
            @endphp $total += $item->price * $item->qty; @endphp
            @endforeach
        </tbody>
    </table>

    <div class="total-section">
        <p><strong>Grand Total: ${{ $order->total_price }}</strong></p>
        <p>Payment Mode: {{ $order->payment_mode }}</p>
    </div>

    <div style="clear: both; margin-top: 50px; text-align: center; color: #777;">
        <p>Thank you for shopping with MyShop!</p>
    </div>

</body>
</html>