<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 4/3/2022
 */


namespace App\ApiHelper;

use Illuminate\Support\Facades\Http;

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
        // TODO: Implement getUser() method.
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
}