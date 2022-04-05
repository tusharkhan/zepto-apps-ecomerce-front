<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 4/5/2022
 */
?>

@extends('layouts.user.main.app')

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endpush

@section('content')

    <main>
        <div class="album py-5 bg-light">
            <div class="container">
                <div class="container mt-5 mb-5">
                    <div class="row d-flex justify-content-center">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="images p-3">
                                            <div class="text-center p-4"><img id="main-image"
                                                                              src="{{ $product->image }}"
                                                                              width="250"/>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6 product">
                                        <div class=" p-4">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center"><i
                                                        class="fa fa-long-arrow-left"></i>
                                                    <a href="{{ url()->previous() }}">
                                                        <span
                                                            class="ml-1">Back</span>
                                                    </a>
                                                </div>
                                                <i class="fa fa-shopping-cart text-muted"></i>
                                            </div>
                                            <div class="mt-4 mb-3">
                                                <h5 class="text-uppercase">{{ $product->name }}</h5>
                                                <div class="price d-flex flex-row align-items-center">
                                                    <div class="ml-2">
                                                        <small class="act-price">${{ $product->price }}</small>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection
