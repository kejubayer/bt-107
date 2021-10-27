@extends('layouts.frontend')

@section('main')
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3 class="text-center mt-3">Your Cart</h3>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total Price</th>
                </tr>
                </thead>
                @php
                $total_price = 0;
                $total_quantity = 0;
                @endphp
                <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td>{{$item['name']}}</td>
                        <td>{{$item['price']}}</td>
                        <td>{{$item['quantity']}}</td>
                        <td>{{$item['quantity'] * $item['price']}}</td>
                    </tr>
                    @php
                        $total_price += $item['quantity'] * $item['price'];
                        $total_quantity += $item['quantity'];
                    @endphp
                @endforeach
                <tr>
                    <th></th>
                    <th>Total</th>
                    <th>{{$total_quantity}}</th>
                    <th>{{$total_price}}</th>
                </tr>
                </tbody>
            </table>
            @if($total_quantity>0)
            <a class="btn btn-primary" href="{{route('checkout')}}">Place Order</a>
            @else
                <a class="btn btn-warning" href="{{route('home')}}">Add product to cart!</a>
            @endif
        </div>
    </div>


@endsection
