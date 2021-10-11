@extends('layouts.frontend')

@section('main')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Ecommerce Batch-7</h1>
                <p class="lead text-muted">Something short and leading about the collection below—its contents, the
                    creator, etc.</p>
                <p>
                    <a href="#" class="btn btn-primary my-2">Main call to action</a>
                    <a href="#" class="btn btn-secondary my-2">Secondary action</a>
                </p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                @foreach($products as $product)
                    <div class="col">
                        <div class="card shadow-sm">
                            <img src="{{$product->photo}}" alt="">

                            <div class="card-body">
                                <h3>{{$product->name}}</h3>
                                <p class="card-text">{{$product->description}}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-outline-secondary">Add to cart</button>
                                    </div>
                                    <small class="text-muted">{{$product->price}} <strong>৳</strong></small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{$products->links()}}

            </div>
        </div>
    </div>

@endsection
