<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 4/3/2022
 */
?>
<form action="{{ route('admin.product.edit.post', $product->id) }}" enctype="multipart/form-data" method="post">
    <div class="modal-body">
        @csrf
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text"  class="form-control" id="name" value="{{ $product->name }}" name="name" placeholder="Enter name">
        </div>

        <label for="basic-url" class="form-label">Price</label>
        <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input type="text" class="form-control" name="price" value="{{ $product->price }}" placeholder="Price">
        </div>

        <div class="form-group">
            <label for="password">Image</label>
            <input type="file"  class="form-control" id="password" name="image" placeholder="Enter password" >

            <div class="col-md-3 mt-5">
                <img  class="img-thumbnail w-75" src="{{ $product->image }}" alt="{{ $product->name }}">
            </div>

        </div>

    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Edit Product</button>
    </div>
</form>
