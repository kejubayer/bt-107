@extends('layouts.frontend')

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="text-center mt-3">Order Info</h3>
                <p><strong>Customer Name: </strong>{{$order->name}}</p>
                <p><strong>Phone Number: </strong>{{$order->phone}}</p>
                <p><strong>Email Address: </strong>{{$order->email}}</p>
                <p><strong>Address: </strong>{{$order->address}}</p>
                <p><strong>Total Price: </strong>{{$order->price}}</p>

            </div>
            <div class="col-md-6">
                <h3 class="text-center mt-3">Product Details</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Product Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total Price</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($order->detail as $detail)
                        <tr>
                            <td>{{$detail->name}}</td>
                            <td>{{$detail->price}}</td>
                            <td>{{$detail->quantity}}</td>
                            <td>{{$detail->quantity * $detail->price}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{route('profile')}}" class="btn btn-primary">Back to Profile</a>
            </div>
        </div>
    </div>


@endsection
