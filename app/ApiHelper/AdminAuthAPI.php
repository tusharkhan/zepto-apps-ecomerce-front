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
    public static $adminEndpoint;
    public static $loginEndpoint;
    public static $logoutEndpoint;


    public static function init()
    {
        self::$adminEndpoint = config('api.admin_endpoint');
        self::$apiEndpoint = config('api.api_endpoint');

        self::$loginEndpoint = self::$adminEndpoint . 'login';
        self::$logoutEndpoint = self::$adminEndpoint . 'logout';
    }

    public static function getUser()
    {
        self::init();
        if (Session::has('admin.login') && Session::get('admin.login') == true) {
            return Session::get('admin.user');
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
        return Http::post(self::$loginEndpoint, $data);
    }

    public static function logout()
    {
        // TODO: Implement logout() method.
    }


    /**
     * @return \Illuminate\Http\Client\Response
     */
    public static function getAllProducts(): \Illuminate\Http\Client\Response
    {
        self::init();
        return Http::get(self::$apiEndpoint . 'products');
    }


    /**
     * @param $data
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public static function createProduct($data)
    {
        self::init();

        $dataToSend = self::productPostData($data);

        $image = $data->file('image');

        $headers = [
            'Authorization' => 'Bearer ' . Session::get('admin.token')
        ];

        return Http::withHeaders($headers)
            ->attach('image', file_get_contents($image), $image->getClientOriginalName())
            ->post(self::$adminEndpoint . 'products', $dataToSend);
    }


    /**
     * @param $data
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public static function updateProduct($data)
    {
        self::init();

        $dataToSend = self::productPostData($data);

        $image = null;

        if ($data->hasFile('image'))
            $image = $data->file('image');

        $headers = [
            'Authorization' => 'Bearer ' . Session::get('admin.token')
        ];

        $http = Http::withHeaders($headers);

        if ($image) {
            $http = $http->attach('image', file_get_contents($image), $image->getClientOriginalName());
        }

        return $http->post(self::$adminEndpoint . 'products/' . $data->id, $dataToSend);
    }

    /**
     * @param $id
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public static function deleteProduct($id)
    {
        self::init();

        $headers = [
            'Authorization' => 'Bearer ' . Session::get('admin.token')
        ];

        return Http::withHeaders($headers)->delete(self::$adminEndpoint . 'products/' . $id);
    }

    /**
     * @param $id
     * @return \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response
     */
    public static function getProduct($id)
    {
        self::init();

        $headers = [
            'Authorization' => 'Bearer ' . Session::get('admin.token')
        ];

        return Http::withHeaders($headers)->get(self::$adminEndpoint . 'products/' . $id);
    }


    /**
     * @param $slug
     * @return \Illuminate\Http\Client\Response
     */
    public static function productBySlug($slug): \Illuminate\Http\Client\Response
    {
        self::init();
        return Http::get(self::$apiEndpoint . 'products/' . $slug);
    }


    /**
     * @param $data
     * @return \Illuminate\Http\Client\Response
     */
    public static function searchProductByName($data): \Illuminate\Http\Client\Response
    {
        self::init();
        return Http::get(self::$apiEndpoint . 'products/search/name?query=' . $data);
    }


    private static function productPostData($request)
    {
        return [
            'name' => $request->name,
            'price' => $request->price,
        ];
    }

}
