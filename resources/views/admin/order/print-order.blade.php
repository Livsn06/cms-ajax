<!DOCTYPE html>
<html>

<head>
    <title>Booking Summary #{{ $booking->id }}</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 40px;
            color: #333;
        }

        .header {
            border-bottom: 2px solid #f2f2f2;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #eee;
        }

        .total-box {
            margin-top: 30px;
            text-align: right;
            background: #f9f9f9;
            padding: 20px;
        }

        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()">Confirm Print</button>
    </div>

    <div class="header">
        <h1>Booking Summary</h1>
        <p>Booking ID: #{{ $booking->id }} | Date: {{ $booking->created_at->format('M d, Y') }}</p>
    </div>

    <h3>Customer Details</h3>
    <p><strong>Name:</strong> {{ $booking->fullname }}</p>
    <p><strong>Phone:</strong> {{ $booking->phone }}</p>
    <p><strong>Event Date:</strong> {{ \Carbon\Carbon::parse($booking->event_date)->format('F d, Y') }}</p>

    <h3>Package: {{ $booking->package->name }}</h3>
    <table>
        <thead>
            <tr>
                <th>Description</th>
                <th>Rate</th>
                <th>Qty (Guests)</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $booking->package->name }} Package</td>
                <td>₱{{ number_format($booking->package->price, 2) }}</td>
                <td>{{ $booking->guest_count }}</td>
                <td>₱{{ number_format($booking->total_price, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <h3>Payment History</h3>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Method</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($booking->payments as $payment)
                <tr>
                    <td>{{ $payment->created_at->format('M d, Y') }}</td>
                    <td>{{ strtoupper($payment->payment_method) }}</td>
                    <td>₱{{ number_format($payment->amount, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total-box">
        <p>Grand Total: ₱{{ number_format($booking->total_price, 2) }}</p>
        <p>Paid to Date: ₱{{ number_format($booking->payments->sum('amount'), 2) }}</p>
        <h2 style="color: #e67e22;">Balance Due:
            ₱{{ number_format($booking->total_price - $booking->payments->sum('amount'), 2) }}</h2>
    </div>
</body>

</html>
