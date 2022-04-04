<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 4/3/2022
 */
?>
@extends('layouts.admin.main.adminLayout')

@section('adminContent')
    <div class="page-wrapper">

        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <!-- ============================================================== -->
        <div class="container-fluid">

            <div class="col-md-6 float-end mb-5">
                <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" id="modal_button" class="btn btn-success float-end">
                    <i class="fa fa-plus-circle"></i>
                    Create Product
                </button>
            </div>

            <table id="myTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>{{$product->name}}</td>
                            <td><img src="{{$product->image}}" alt="{{$product->name}}" width="100px" height="100px"></td>
                            <td>${{$product->price}}</td>
                            <td>
                                <button type="button" onclick="editProduct({{$product->id}})" class="btn btn-primary">Edit</button>
                                <a href="{{route('admin.product.delete',$product->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tFoot>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </tFoot>
            </table>

        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div id="mainBody"></div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="spinnerModal" tabindex="-1" aria-labelledby="spinnerModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered justify-content-center">
                <div class="d-flex justify-content-center" >
                    <div class="spinner-grow" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- footer -->
        <!-- ============================================================== -->
        <footer class="footer text-center"> {{ date('Y') }} © Admin</footer>
        <!-- ============================================================== -->
        <!-- End footer -->
        <!-- ============================================================== -->
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>

    <script>
        var modal_button = $('#modal_button');
        var exampleModalLabel = $('#exampleModalLabel');
        var mainBody = $('#mainBody');
        var exampleModal = $('#exampleModal');

        modal_button.click(function () {
            exampleModalLabel.text('Create Product');
            $.ajax({
                url: '{{route('admin.product.create.get')}}',
                type: 'GET',
                success: function (data) {
                    mainBody.html(data.view);
                }
            });
        });


        function editProduct(id) {
            let loader = $('#spinnerModal');
            let mainBody = $('#mainBody');

            loader.modal('show');


            exampleModalLabel.text('Edit Product');

            let url = window.location.origin +  '/admin/product/edit/' + id;

            $.ajax({
                url: url,
                type: 'GET',
                success: function (data) {
                    loader.modal('hide');
                    if( data.success == true ){
                        console.log(data.view);
                        exampleModal.modal('show');
                        mainBody.html(data.view);
                    } else {
                        toastr.info(data.error);
                    }
                }, error: function (data) {
                    loader.modal('hide');
                    toastr.error('Something went wrong');
                }
            });
        }
    </script>

@endpush
