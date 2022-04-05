<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 4/5/2022
 */

?>
@extends('layouts.user.main.app')

@section('content')
    <main>

        <section class="py-5 text-center homeBanner container"
                 style="background-image: url('{{ asset("admin/images/main/s-o-c-i-a-l-c-u-t-aXJdmnxauwY-unsplash.jpg") }}')">
            <div class="row py-lg-4">
                <div class="col-lg-6 mt-5 col-md-8 mx-auto">
                    <h1 class="fw-dark">SHOP</h1>
                    <p class=" text-dark font-20">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque nisl
                        eros, pulvinar facilisis justo mollis</p>
                </div>
            </div>
        </section>

        <div class="album py-5 bg-light">
            <div class="container">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @foreach($products as $product)
                        <div class="col">
                            <div class="card shadow-sm">

                                <div class="card-img">
                                    <img class="w-100" src="{{ $product->image }}" alt="{{ $product->name }}">
                                </div>

                                <div class="card-body">
                                    <h6 class="card-text">{{ $product->name }}</h6>
                                    <p> price: $ {{$product->price}}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a type="button" href="{{ route('single.product', $product->slug) }}"
                                               class="btn btn-outline-secondary">View</a>
                                        </div>
                                        <small
                                            class="text-muted">{{ date('d, M Y', strtotime($product->created_at)) }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </main>
@endsection
