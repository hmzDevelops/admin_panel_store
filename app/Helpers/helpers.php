<?php

use Morilog\Jalali\Jalalian;

    function jalali_date($date , $format='%A %Y.%m.%d'){
        return Jalalian::forge($date)->format($format); // جمعه، 23 اسفند 97
    }

    //define helpers in composer.hson
    //composer dump-autoload => command line for excute helpers
?>
