<?php

namespace App\Http\Controllers\Auth\User;

use App\ApiHelper\UserAuthAPI;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Toastr;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('layouts.user.login');
    }


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


        $response = UserAuthAPI::login($data);

        $code = $response->getStatusCode();
        $responseData = json_decode($response->getBody()->getContents());

        if ($code == 200) {
            Session::put('user.login', true);
            Session::put('user.token', $responseData->data->access_token);
            Session::put('user.user', $responseData->data->user);

            Toastr::success('Login Successfully');

            return redirect()->route('home');
        } else {
            Session::put('login.api.errors', $responseData->errors->error);

            Toastr::error($responseData->errors->error);

            return redirect()->back();
        }
    }
}
