<?php
/**
 * created by: tushar Khan
 * email : tushar.khan0122@gmail.com
 * date : 4/3/2022
 */


use Illuminate\Routing\Route;

if ( ! function_exists('checkLogin') ){
    /**
     * @param $checkFor
     * @return bool
     */
    function checkLogin($checkFor){
        return (
        \Illuminate\Support\Facades\Session::has($checkFor.'.login') &&
        \Illuminate\Support\Facades\Session::get($checkFor.'.login') == true
        );
    }
}



if ( ! function_exists('matchRouteName') ){
    /**
     * @param $current
     * @param $match
     * @return bool
     */
    function matchRouteName($current, $match){
        return strpos( $current, $match) !== false;
    }
}
