<?php

use Morilog\Jalali\Jalalian;

    function jalali_date($date , $format='%A %Y.%m.%d'){
        return Jalalian::forge($date)->format($format); // جمعه، 23 اسفند 97
    }


    function unset_session($key){
         session()->forget($key);
    }

    //define helpers in composer.json
    //composer dump-autoload => command line for excute helpers
?>
