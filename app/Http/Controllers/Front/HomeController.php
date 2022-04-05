<?php

namespace App\Http\Controllers\Front;

use App\ApiHelper\AdminAuthAPI;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Toastr;

class HomeController extends Controller
{
    public function index()
    {
        $data['products'] = [];

        AdminAuthAPI::init();
        $products = AdminAuthAPI::getAllProducts();

        if ($products->getStatusCode() == 200) {
            $content = $products->getBody()->getContents();
            $data['products'] = json_decode($content)->data->data;
        } else {
            $data['products'] = [];
        }

        return view('layouts.user.index', $data);
    }


    public function single($slug)
    {
        $data['product'] = [];

        AdminAuthAPI::init();
        $product = AdminAuthAPI::productBySlug($slug);

        if ($product->getStatusCode() == 200) {
            $content = $product->getBody()->getContents();
            $data['product'] = json_decode($content)->data;
        } else {
            Toastr::warning('Product not found');
            return redirect()->route('home');
        }

        return view('layouts.user.single_product', $data);
    }


    public function searchProductByName(Request $request)
    {
        $data['products'] = [];

        AdminAuthAPI::init();
        $products = AdminAuthAPI::searchProductByName($request->name);

        if ($products->getStatusCode() == 200) {
            $content = $products->getBody()->getContents();
            $data['products'] = json_decode($content)->data;
        } else {
            $data['products'] = [];
        }

        return response()->json([
            'status' => true,
            'data' => $data['products'],
        ]);
    }
}
