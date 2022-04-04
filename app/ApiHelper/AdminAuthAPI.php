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


    public static function createProduct($data)
    {
        $dataToSend = self::productPostData($data);

        $image = $data->file('image');

        $headers = [
            'Authorization' => 'Bearer ' . Session::get('admin.token')
        ];

        return Http::withHeaders($headers)
            ->attach('image', file_get_contents($image), $image->getClientOriginalName())
            ->post(self::$apiEndpoint . 'products', $dataToSend);
    }


    public static function updateProduct($data)
    {
        $dataToSend = self::productPostData($data);

        $image = null;

        if ( $data->hasFile('image') )
            $image = $data->file('image');

        $headers = [
            'Authorization' => 'Bearer ' . Session::get('admin.token')
        ];

        $http = Http::withHeaders($headers);

        if ( $image ){
            $http = $http->attach('image', file_get_contents($image), $image->getClientOriginalName());
        }

        return $http->post(self::$apiEndpoint . 'products/' . $data->id, $dataToSend);
    }

    public static function deleteProduct($id)
    {
        $headers = [
            'Authorization' => 'Bearer ' . Session::get('admin.token')
        ];

        return Http::withHeaders($headers)->delete(self::$apiEndpoint . 'products/' . $id);
    }

    public static function getProduct($id)
    {
        $headers = [
            'Authorization' => 'Bearer ' . Session::get('admin.token')
        ];

        return Http::withHeaders($headers)->get(self::$apiEndpoint . 'products/' . $id);
    }


    private static function productPostData($request)
    {
        return [
            'name' => $request->name,
            'price' => $request->price,
        ];
    }

}
