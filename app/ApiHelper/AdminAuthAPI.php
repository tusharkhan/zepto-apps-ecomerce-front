<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 4/3/2022
 */


namespace App\ApiHelper;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AdminAuthAPI implements AuthInterface
{

    public static $apiEndpoint;
    public static $loginEndpoint;
    public static $logoutEndpoint;


    public static function init()
    {
        self::$apiEndpoint = config('api.admin_endpoint');
        self::$loginEndpoint = self::$apiEndpoint . 'login';
        self::$logoutEndpoint = self::$apiEndpoint . 'logout';
    }

    public static function getUser()
    {
        if (Session::has('admin.login') && Session::get('admin.login') == true) {
            return Session::get('admin.user');
        }
        return null;
    }

    /**
     * @param $data
     * @return array|mixed
     */
    public static function login($data)
    {
        return Http::post(self::$loginEndpoint, $data);
    }

    public static function logout()
    {
        // TODO: Implement logout() method.
    }


    public static function getAllProducts()
    {
        $headers = [
            'Authorization' => 'Bearer ' . Session::get('admin.token')
        ];

        return Http::withHeaders($headers)->get(self::$apiEndpoint . 'products');
    }
}
