@extends('layouts.backend')

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 class="text-center mt-3">Order Info</h3>
                <p><strong>Order No: </strong>{{$order->truck_no}}</p>
                <p><strong>Customer Name: </strong>{{$order->name}}</p>
                <p><strong>Phone Number: </strong>{{$order->phone}}</p>
                <p><strong>Email Address: </strong>{{$order->email}}</p>
                <p><strong>Address: </strong>{{$order->address}}</p>
                <p><strong>Total Price: </strong>{{$order->price}}</p>
                <p><strong>Total Quantity: </strong>{{$order->quantity}}</p>
                <p><strong>Payment Method: </strong>{{$order->payment_method}}</p>
                <p><strong>Txn Id: </strong>{{$order->txn_id}}</p>
                <p class="text-capitalize"><strong>Status: </strong>{{$order->status}}</p>

            </div>
            <div class="col-md-6">
                <h3 class="text-center mt-3">Change Status</h3>
                <div>
                    <form action="{{route('admin.order.update',$order->id)}}" method="post">
                        @csrf
                        <select name="status" class="form-control">
                            <option value="pending" {{$order->status == 'pending'?'selected':''}} >Pending</option>
                            <option value="confirmed" {{$order->status == 'confirmed'?'selected':''}} >Confirmed
                            </option>
                            <option value="precessing" {{$order->status == 'precessing'?'selected':''}} >Precessing
                            </option>
                            <option value="completed" {{$order->status == 'completed'?'selected':''}} >Completed
                            </option>
                            <option value="rejected" {{$order->status == 'rejected'?'selected':''}} >Rejected</option>
                        </select>
                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form>
                </div>

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
            </div>
        </div>
    </div>


@endsection
