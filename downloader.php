<?php
/**
 * Created by PhpStorm.
 * User: @xainse
 * Date: 10.12.2015
 * Time: 21:24
 * http://ru.slovoidilo.ua/articles/4285/2014-08-16/karta-ato-po-sostoyaniyu-na-16-avgusta-v-dinamike.html
 */

/**
 * download file and save to destination
 * @param $src - file source link
 * @param $dest - file destination local path
 */
function downloadAllImgs($src='', $dest='') {
    echo '1';
    //$startDay = "2014-07-28";
    $errFile = 'errors.log';
//    $startDay = "2014-08-13";
    $startDay = "2015-12-09";
    $startTimestamp = strtotime($startDay);
    $stopDay = "2015-12-24";
    $oneDay = 60*60*24;
    $pathSave = 'img/photos/';
    $smlImgWidth = 300;

    $countDays = (strtotime($stopDay) - strtotime($startDay))/$oneDay;
    $handle = fopen($errFile, 'w');

    for ($i=0; $i<$countDays; $i++) {
        $curDateTime = $startTimestamp + $oneDay*$i;
        $dYear = date('Y', $curDateTime);
        $dMonth = date('m', $curDateTime);
        $dDay = date('d', $curDateTime);

        // http://mediarnbo.org/wp-content/uploads/2014/08/13-08.jpg
        // http://mediarnbo.org/wp-content/uploads/2014/08/15-08.jpg
        $url = 'http://mediarnbo.org/wp-content/uploads/' . $dYear .'/'.$dMonth.'/';
        $imgName = $dDay.'-'.$dMonth.'.jpg';

        $source = 'big-'.$dYear.'-'.$dMonth.'-'.$dDay.'.jpg';
        $target = 'sml-'.$dYear.'-'.$dMonth.'-'.$dDay.'.jpg';
        try {
            copy ($url.$imgName, $pathSave.$source);
        } catch (Exception $e) {
            $s = "Not exist: " . $url.$imgName."\n";
            fwrite($handle,$s);
        }

        sleep(1);
        if (file_exists($pathSave.$source)){
            resize($smlImgWidth, $pathSave.$target, $pathSave.$source);
            print_r($i."\n");
        } else {
            print_r("Not exist: " . $url.$imgName."\n");
        }
    }
    fclose($handle);
}

/**
 * Create a small thumbnail with the specified width
 * @param $newWidth - int
 * @param $targetFile
 * @param $originalFile
 */
function resize($newWidth, $targetFile, $originalFile) {

    $info = getimagesize($originalFile);
    $mime = $info['mime'];

    $image_create_func = 'imagecreatefromjpeg';
    $image_save_func = 'imagejpeg';

    $img = $image_create_func($originalFile);
    list($width, $height) = getimagesize($originalFile);

    $newHeight = ($height / $width) * $newWidth;
    $tmp = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

    if (file_exists($targetFile)) {
        unlink($targetFile);
    }
    $image_save_func($tmp, $targetFile);
}

downloadAllImgs();

function wln($var='ok'){
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

