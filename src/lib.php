<?php
/**
 * Created by PhpStorm.
 * User: @xainse
 * Date: 26.12.2015
 * Time: 11:33
 */

define('ONE_DAY', 60*60*24);
define('ERRORS_FILE','errors.log');
define('SOURCE_LINK', 'http://mediarnbo.org/wp-content/uploads/');

if ($_SERVER['SERVER_ADDR'] == '127.0.0.1') {
    define('PATH_SAVE', 'd:\OpenServer\domains\ato-map.dev\img\manualy\\');    
} else {
    define('PATH_SAVE', '/sata1/home/users/onlinegam/www/ato-map.xain.in.ua/img/photos/');   
}

define('SML_IMG_WIDTH', 300);
define('HOST', 'http://ato-map.xain.in.ua/');

define('FILE_NAME_PREFIX_BIG', 'big');
define('FILE_NAME_PREFIX_SML', 'sml');

/**
  * Link that wasn't be downloaded:
  * - http://mediarnbo.org/wp-content/uploads/2016/02/04-02.jpg
  * - http://mediarnbo.org/wp-content/uploads/2016/02/11-02.jpg
    - http://mediarnbo.org/wp-content/uploads/2016/02/12-02.jpg
  *
  */


/**
 * download file and save to destination
 */
function downloadAllImgs() {
    echo '1';
    //$startDay = "2014-07-28";
//    $startDay = "2014-08-13";
    $startDay = "2016-02-07";
    $startTimestamp = strtotime($startDay);
    $stopDay = "2016-02-11";

    $countDays = (strtotime($stopDay) - strtotime($startDay))/ONE_DAY;

    for ($i=0; $i<$countDays; $i++) {
        $curDateTime = $startTimestamp + ONE_DAY*$i;
        getOneMap($curDateTime);
    }
}

/**
 * Сачати картинку за вказану дату
 * @param $timestamp
 *  
 */
function getOneMap($timestamp) {

    ini_set("allow_url_fopen", 1);

    $dYear = date('Y', $timestamp);
    $dMonth = date('m', $timestamp);
    $dDay = date('d', $timestamp);

    // http://mediarnbo.org/wp-content/uploads/2014/08/13-08.jpg
    // http://mediarnbo.org/wp-content/uploads/2014/08/15-08.jpg
    $url = SOURCE_LINK . $dYear .'/'.$dMonth.'/';
    $imgName = $dDay.'-'.$dMonth.'.jpg';

    $handle = fopen(ERRORS_FILE, 'w'); // file to write errors

    $source = getFilenameOnDiskBig($timestamp);
    $target = getFilenameOnDiskSml($timestamp);
    try {
        copy ($url.$imgName, PATH_SAVE.$source);
    } catch (Exception $e) {
        $s = "Not exist: " . $url.$imgName."\n";
        fwrite($handle,$s);
    }

//    wln($url.$imgName);

    sleep(1);
    if (file_exists(PATH_SAVE.$source)){
        resize(SML_IMG_WIDTH, PATH_SAVE.$target, PATH_SAVE.$source);
        echo '<img src="'.HOST.'img/photos/'.$target.'"/>';
    } else {
        print_r("Not exist: " . $url.$imgName."\n");
    }

    fclose($handle);
}

/**
 * Download map for today day
 */
function getTodayMap() {
    getOneMap(time());
}

/**
 * Create link to source file of map by timestamp
 * @param $timestamp
 * @return string
 */
function getLinkToSourceFile($timestamp) {
    $dYear = date('Y', $timestamp);
    $dMonth = date('m', $timestamp);
    $dDay = date('d', $timestamp);

    $url = SOURCE_LINK . $dYear .'/'.$dMonth.'/';
    $imgName = $dDay.'-'.$dMonth.'.jpg';

    return $url.$imgName;
}

/**
 * Create filename of the big image from timestamp
 * @param $timestamp
 * @return string
 */
function getFilenameOnDiskBig($timestamp) {

    $dYear = date('Y', $timestamp);
    $dMonth = date('m', $timestamp);
    $dDay = date('d', $timestamp);

    return FILE_NAME_PREFIX_BIG.'-'.$dYear.'-'.$dMonth.'-'.$dDay.'.jpg';
}

/**
 * Create filename of the sml image from timestamp
 * @param $timestamp
 * @return string
 */
function getFilenameOnDiskSml($timestamp) {

    $dYear = date('Y', $timestamp);
    $dMonth = date('m', $timestamp);
    $dDay = date('d', $timestamp);

    return FILE_NAME_PREFIX_SML.'-'.$dYear.'-'.$dMonth.'-'.$dDay.'.jpg';
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

/**
 * Debuging
 * @param string $var
 */
function wln($var='ok'){
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}
