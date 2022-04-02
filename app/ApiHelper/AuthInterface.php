<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 4/3/2022
 */


namespace App\ApiHelper;

interface AuthInterface
{
    public static function getUser();

    public static function login($data);

    public static function logout();
}
