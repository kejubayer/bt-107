@extends('layouts.backend')

@section('main')
    <div class="row mt-3">
        <h2 class="text-center">Edit Product</h2>
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form action="{{route('admin.product.edit',$product->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{$product->name}}">
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{$product->price}}">
                </div>
                <div class="mb-3">
                    <label for="discount" class="form-label">Discount</label>
                    <input type="number" class="form-control" id="discount" name="discount" value="{{$product->discount}}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="5">{{$product->description}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" name="photo" id="photo" class="form-control">
                    <img src="{{asset('uploads/products/'.$product->photo)}}" alt="" width="100px" class="m-3">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection
