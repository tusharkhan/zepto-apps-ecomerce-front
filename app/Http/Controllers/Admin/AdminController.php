<?php

namespace App\Http\Controllers\Admin;

use App\ApiHelper\AdminAuthAPI;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Toastr;

class AdminController extends Controller
{
    public function dashboard()
    {
        $products = AdminAuthAPI::getAllProducts();

        $content = $products->getBody()->getContents();
        $data['products'] = [];

        if ( $products->getStatusCode() == 200 ) {
            $data['products'] = json_decode($content)->data->data;
        } else {
            Toastr::error(json_decode($content)->errors->error);
        }

        return view('layouts.admin.dashboard', $data);
    }


    public function createProductView()
    {
        return response()->json(['success' => true, 'view' => view('layouts.admin.create')->render()]);
    }


    public function editProductView($id)
    {
        $product = AdminAuthAPI::getProduct($id);

        if ( $product->getStatusCode() == 200 ) {
            $data['product'] = json_decode($product->getBody()->getContents())->data;
        } else {
            return response()->json(['success' => false, 'error' => 'Product not found']);
        }

        return response()->json(['success' => true, 'view' => view('layouts.admin.edit', $data)->render()]);
    }

    public function createProduct(Request $request)
    {
        $product = AdminAuthAPI::createProduct($request);

        if ( $product->getStatusCode() == 201 ) {
            Toastr::success('Product created successfully');
            return redirect()->back();
        } else {
            Toastr::error('Something went wrong');
            return redirect()->back();
        }
    }


    public function editProduct(Request $request)
    {
        $product = AdminAuthAPI::updateProduct($request);

        if ( $product->getStatusCode() == 200 ) {
            Toastr::success('Product updated successfully');
            return redirect()->back();
        } else {
            Toastr::error('Something went wrong');
            return redirect()->back();
        }
    }


    public function deleteProduct($id)
    {
        $product = AdminAuthAPI::deleteProduct($id);

        if ( $product->getStatusCode() == 200 ) {
            Toastr::warning('Product deleted successfully');
            return redirect()->back();
        } else {
            Toastr::error('Something went wrong');
            return redirect()->back();
        }
    }
}
