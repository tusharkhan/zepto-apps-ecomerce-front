<?php

namespace App\Http\Controllers\Admin;

use App\ApiHelper\AdminAuthAPI;
use App\Http\Controllers\Controller;
use Toastr;

class AdminController extends Controller
{
    public function dashboard()
    {
        AdminAuthAPI::init();
        $products = AdminAuthAPI::getAllProducts();

        if ( $products->getStatusCode() == 200 ) {
            $data['products'] = json_decode($products->getBody()->getContents())->data;
        } else {
            $data['products'] = [];
        }

        return view('layouts.admin.dashboard', $data);
    }


    public function editProduct()
    {
        
    }


    public function deleteProduct()
    {
        
    }
}
