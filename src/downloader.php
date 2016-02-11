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

getOneMap(time() - ONE_DAY);

//downloadAllImgs();

function wln($var='ok'){
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

