<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 30px;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
        }

        .invoice-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .invoice-header h2 {
            margin: 0;
        }

        .info-section {
            margin-bottom: 20px;
        }

        .info-section strong {
            display: inline-block;
            width: 150px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        table th {
            background-color: #f2f2f2;
        }

        .total {
            text-align: right;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: gray;
        }
    </style>
</head>
<body>

<div class="invoice-box">

    <div class="invoice-header">
        <h2>CREATICS</h2>
        <p>Date: {{ date('d-m-Y') }}</p>
    </div>

    <div class="info-section">
        <p><strong>Customer Name:</strong> {{ $data->user->name }}</p>
        <p><strong>Address:</strong> {{ $data->receiver_address }}</p>
        <p><strong>Phone:</strong> {{ $data->receiver_phone }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Product</th>
                <th>Price (PKR)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $data->product->product_title }}</td>
                <td>{{ $data->product->product_price }}</td>
            </tr>
        </tbody>
    </table>

    <p class="total">
        Total: PKR {{ $data->product->product_price }}
    </p>

    <div class="footer">
        Thank you for your purchase!
    </div>

</div>

</body>
</html>