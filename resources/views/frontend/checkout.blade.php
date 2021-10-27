@extends('layouts.frontend')

@section('main')
    <div class="container">
        <div class="row">
            <h3 class="text-center mt-3">Checkout please</h3>
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
            </div>

            <div class="col-md-6 mt-5">
                <form action="{{route('checkout')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" required placeholder="Enter you name" value="{{auth()->user()->name}}">
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <input type="hidden" name="price" value="{{$total_price}}">
                    <input type="hidden" name="quantity" value="{{$total_quantity}}">
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone number</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" required placeholder="Enter you phone number" value="{{auth()->user()->phone}}">
                        @error('phone')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter your address">{{auth()->user()->address}}</textarea>
                        @error('address')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                               aria-describedby="emailHelp" required placeholder="Enter your email" value="{{auth()->user()->email}}">
                        @error('email')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="payment_method" class="form-label">Select Payment Method</label>
                        <select name="payment_method" id="payment_method" class="form-control @error('payment_method') is-invalid @enderror">
                            <option value="Bkash">Bkash</option>
                            <option value="Rocket">Rocket</option>
                            <option value="Nagod">Nagod</option>
                        </select>
                        @error('payment_method')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="txn_id" class="form-label">Email address</label>
                        <input type="text" name="txn_id" class="form-control @error('txn_id') is-invalid @enderror" id="txn_id"
                               aria-describedby="emailHelp" required placeholder="Enter your Txn ID" value="{{old('txn_id')}}">
                        @error('txn_id')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
