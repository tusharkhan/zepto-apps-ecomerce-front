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
        if (checkLogin('user'))
            return redirect(route('home'));

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

            Session::put('login.api.success', 'Login Successfully');

            return redirect()->route('home');
        } else {
            Session::put('login.api.errors', $responseData->errors->error);

            Toastr::error($responseData->errors->error);

            return redirect()->back();
        }
    }


    public function showRegistrationForm()
    {
        if (checkLogin('user'))
            return redirect(route('home'));

        return view('layouts.user.registration');
    }


    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            Session::put('errors', $validator->errors()->all());
            return redirect()->back();
        }

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation
        );

        $response = UserAuthAPI::registration($data);

        $code = $response->getStatusCode();
        $responseData = json_decode($response->getBody()->getContents());

        if ($code == 200) {
            Session::put('user.login', true);
            Session::put('user.token', $responseData->data->access_token);
            Session::put('user.user', $responseData->data->user);

            Session::put('login.api.success', 'Registration Successfully');

            return redirect()->route('home');
        } else {
            Session::put('login.api.errors', $responseData->errors->error);

            Toastr::error($responseData->errors->error);

            return redirect()->back();
        }
    }


    public function logout()
    {
        if (Session::has('user.login')) {
            Session::forget('user.login');
            Session::forget('user.token');
            Session::forget('user.user');

            Session::put('login.api.success', 'Logout Successfully');
        }

        return redirect()->route('home');
    }
}
