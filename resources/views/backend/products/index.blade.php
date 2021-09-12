@extends('layouts.backend')

@section('main')
    <div class="mt-3">
        <h2 class="text-center">Products List</h2>
        <a href="{{route('admin.product.create')}}" class="btn btn-success">Add new product</a>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Discount</th>
                <th scope="col">Desc</th>
                <th scope="col">Photo</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $key=>$product)
            <tr>
                <th scope="row">{{$key+1}}</th>
                <td>{{$product->name}}</td>
                <td>{{$product->price}}</td>
                <td>{{$product->discount}}</td>
                <td>{{$product->description}}</td>
                <td>
                    <img src="{{asset('uploads/products/'.$product->photo)}}" alt="" width="100px">
                </td>
                <td>
                    <a href="{{route('admin.product.edit',$product->id)}}" class="btn btn-warning">Edit</a>
                    <a href="{{route('admin.product.delete',$product->id)}}" class="btn btn-danger">Delete</a>
                </td>

            </tr>
            @endforeach

            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
