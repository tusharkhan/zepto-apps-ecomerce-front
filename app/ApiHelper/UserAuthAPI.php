<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 4/7/2022
 */


namespace App\ApiHelper;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UserAuthAPI implements AuthInterface
{
    public static $apiEndpoint;
    public static $userEndpoint;
    public static $loginEndpoint;
    public static $logoutEndpoint;
    public static $registerEndpoint;

    public static function init()
    {
        self::$apiEndpoint = config('api.api_endpoint');
        self::$userEndpoint = config('api.user_endpoint');
        self::$loginEndpoint = 'login';
        self::$logoutEndpoint = 'logout';
        self::$registerEndpoint = 'register';
    }

    public static function getUser()
    {
        if (Session::has('user.login') && Session::get('user.login') == true) {
            return Session::get('user.user');
        }
        return null;
    }

    /**
     * @param $data
     * @return \Illuminate\Http\Client\Response
     */
    public static function login($data): \Illuminate\Http\Client\Response
    {
        self::init();

        $url = self::$userEndpoint . self::$loginEndpoint;
        return Http::post($url, $data);
    }

    public static function logout()
    {
        // TODO: Implement logout() method.
    }
}
