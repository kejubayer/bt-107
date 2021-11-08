@extends('layouts.backend')

@section('main')
    <div class="mt-3">
        <h2 class="text-center">All Order List</h2>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Order No</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Phone Number</th>
                <th scope="col">Address</th>
                <th scope="col">Price</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Txn Id</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders as $key=>$order)
                <tr>
                    <th scope="row">{{$key+1}}</th>
                    <td>{{$order->truck_no}}</td>
                    <td>{{$order->name}}</td>
                    <td>{{$order->phone}}</td>
                    <td>{{$order->address}}</td>
                    <td>{{$order->price}}</td>
                    <td>{{$order->payment_method}}</td>
                    <td>{{$order->txn_id}}</td>
                    <td class="text-capitalize">{{$order->status}}</td>
                    <td>
                        <a href="{{route('admin.order.show',$order->id)}}" class="btn btn-warning">View</a>
                    </td>

                </tr>
            @endforeach

            </tbody>
        </table>
        {{ $orders->links() }}
    </div>
@endsection
