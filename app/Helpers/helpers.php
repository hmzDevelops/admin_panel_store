<?php

use Morilog\Jalali\Jalalian;

function jalali_date($date, $format = '%A %Y.%m.%d')
{
    return Jalalian::forge($date)->format($format); // جمعه، 23 اسفند 97
}


function unset_session($key)
{
    session()->forget($key);
}

function digitGroup($number)
{
    return number_format($number, 0, '.', ',');
}

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
    //define helpers in composer.json
    //composer dump-autoload => command line for excute helpers
