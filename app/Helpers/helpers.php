<?php

use Morilog\Jalali\Jalalian;

function jalali_date($date, $format = '%A %Y.%m.%d')
{
    return Jalalian::forge($date)->format($format); // جمعه، 23 اسفند 97
}


//session delete
function unset_session($key)
{
    session()->forget($key);
}

//digit group
function digitGroup($number)
{
    $number = number_format($number, 0, '/', ',');
    $number = convertDigitEnToFa($number);
    return $number;
}

//is connect
function is_connected()
{
    $connected = @fsockopen("https://www.google.com", 80);
    //website, port  (try 80 or 443)
    if ($connected) {
        $is_conn = true; //action when connected
        fclose($connected);
    } else {
        $is_conn = false; //action in connection failure
    }
    return $is_conn;
}


function convertDigitFaToEn($number){
    $number = str_replace('۰', '0', $number);
    $number = str_replace('۱', '1', $number);
    $number = str_replace('۲', '2', $number);
    $number = str_replace('۳', '3', $number);
    $number = str_replace('۴', '4', $number);
    $number = str_replace('۵', '5', $number);
    $number = str_replace('۶', '6', $number);
    $number = str_replace('۷', '7', $number);
    $number = str_replace('۸', '8', $number);
    $number = str_replace('۹', '9', $number);

    return $number;
}

function convertDigitEnToFa($number){
    $number = str_replace('0','۰', $number);
    $number = str_replace('1','۱', $number);
    $number = str_replace('2','۲', $number);
    $number = str_replace('3','۳', $number);
    $number = str_replace('4','۴', $number);
    $number = str_replace('5','۵', $number);
    $number = str_replace('6','۶', $number);
    $number = str_replace('7','۷', $number);
    $number = str_replace('8','۸', $number);
    $number = str_replace('9','۹', $number);

    return $number;
}
    //define helpers in composer.json
    //composer dump-autoload => command line for excute helpers
