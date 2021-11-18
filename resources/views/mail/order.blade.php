<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Mail</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>

<div>
    <h3>Order Info</h3>
    <p><strong>Customer Name: </strong>{{$order->name}}</p>
    <p><strong>Phone Number: </strong>{{$order->phone}}</p>
    <p><strong>Email Address: </strong>{{$order->email}}</p>
    <p><strong>Address: </strong>{{$order->address}}</p>
    <p><strong>Total Price: </strong>{{$order->price}}</p>
</div>
<div>
    <h3>Product details</h3>
    <table style="width:100%">
        <tr>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
        </tr>
        @foreach($order->detail as $detail)
            <tr>
                <td>{{$detail->name}}</td>
                <td>{{$detail->price}}</td>
                <td>{{$detail->quantity}}</td>
                <td>{{$detail->quantity * $detail->price}}</td>
            </tr>
        @endforeach
    </table>
</div>


</body>
</html>
