@extends('layouts.frontend')

@section('main')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 mt-5">
                <h1 class="text-center mb-3">Register</h1>
               {{-- @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif--}}
                <form action="{{route('register')}}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Full name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" required placeholder="Enter you name" value="{{old('name')}}">
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone number</label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" required placeholder="Enter you phone number" value="{{old('phone')}}">
                        @error('phone')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter your address">{{old('address')}}</textarea>
                        @error('address')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                               aria-describedby="emailHelp" required placeholder="Enter your email" value="{{old('email')}}">
                        @error('email')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" required placeholder="Enter password">
                        @error('password')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="c_password" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control @error('password') is-invalid @enderror" id="c_password" required placeholder="Confirm password">
                        @error('password')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection
