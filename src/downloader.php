<?php
/**
 * Created by PhpStorm.
 * User: @xainse
 * Date: 10.12.2015
 * Time: 21:24
 * http://ru.slovoidilo.ua/articles/4285/2014-08-16/karta-ato-po-sostoyaniyu-na-16-avgusta-v-dinamike.html
 */


require "lib.php";

//downloadAllImgs();
//getTodayMap();

getOneMap(strtotime('2016-02-15'));
getOneMap(strtotime('2016-02-17'));

//downloadAllImgs();

function wln($var='ok'){
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

