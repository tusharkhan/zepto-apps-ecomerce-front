<?php

namespace App\Http\Controllers\Auth\Admin;

use App\ApiHelper\AdminAuthAPI;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            Session::put('errors', $validator->errors()->all());
            return redirect()->back();
        }

        $data = array(
            'email' => $request->email,
            'password' => $request->password
        );

        AdminAuthAPI::init();
        $response = AdminAuthAPI::login($data);

        $code = $response->getStatusCode();

        if ( $code == 200 ){
            $responseData = json_decode($response->getBody()->getContents());

            Session::put('admin.login', true);
            Session::put('admin.token', $responseData->data->access_token);
            Session::put('admin.user', $responseData->data->user);
        } else {
            Session::put('login.api.errors', array('Invalid email or password'));
        }

        return $code;
    }


    public function showLoginForm()
    {
        return view('layouts.admin.auth.login');
    }
}
