@extends('layouts.frontend')

@section('main')
    <div class="container">
        <div class="row">
            <h1 class="text-center mb-3">Profile</h1>

            <div class="col-md-6">
                <h3 class="text-center">Your details</h3>

                <img src="{{asset('uploads/users/'.auth()->user()->photo)}}" alt=""
                     style="height: 200px; border-radius: 50%">
                {{-- @if ($errors->any())
                     <div class="alert alert-danger">
                         <ul>
                             @foreach ($errors->all() as $error)
                                 <li>{{ $error }}</li>
                             @endforeach
                         </ul>
                     </div>
                 @endif--}}
                <form action="{{route('profile')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               id="name" required placeholder="Enter you name" value="{{auth()->user()->name}}">
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone number</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                               id="phone" required placeholder="Enter you phone number"
                               value="{{auth()->user()->phone}}">
                        @error('phone')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address"
                                  class="form-control @error('address') is-invalid @enderror"
                                  placeholder="Enter your address">{{auth()->user()->address}}</textarea>
                        @error('address')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" value="{{auth()->user()->email}}" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror"
                               id="photo">
                        @error('photo')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Edit Profile</button>
                </form>
            </div>
            <div class="col-md-6">
                <h3 class="text-center mt-3">Your Order</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Order No</th>
                        <th scope="col">Price</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach(auth()->user()->order as $order)
                        <tr>
                            <td>{{$order->truck_no}}</td>
                            <td>{{$order->price}}</td>
                            <td>{{$order->created_at->format('d M, Y')}}</td>
                            <td>{{$order->status}}</td>
                            <td><a href="{{route('profile.order',$order->id)}}" class="btn btn-primary">view</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
