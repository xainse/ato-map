<?php
/**
 * Created by PhpStorm.
 * User: xain
 * Date: 28.02.2016
 * Time: 23:25
 *
 * The Script check the photos for last week and upload missed
 */

require "lib.php";

$daysAgo = 7;
$weekAgo = time() - ONE_DAY * $daysAgo;

print_r("http://ato-map.xain.in.ua/ \r\n");
print_r("File: check-maps2.php \r\n");

<<<<<<< HEAD
wln("Update map images on site http://ato-map.xain.in.ua/");

for ($i = 0; $i < $daysAgo; $i++) {
=======
for ($i = 0; $i <= 7; $i++) {
>>>>>>> 9517c0f85deb5fad2eb58d090ec8ef3653b65e15

    $timestamp = $weekAgo + ONE_DAY*$i;

    $bigMapFile = getFilenameOnDiskBig($timestamp);
    $smlMapFile = getFilenameOnDiskSml($timestamp);

    if (!file_exists(PATH_SAVE.$bigMapFile)){

        $sourceMapFile = getLinkToSourceFile($timestamp);

        copy ($sourceMapFile, PATH_SAVE.$bigMapFile);
        resize(SML_IMG_WIDTH, PATH_SAVE.$smlMapFile, PATH_SAVE.$bigMapFile);
        print_r(($i+1) .'. Save img: '.$bigMapFile."\r\n");
    } else {
        print_r(($i+1) .'. File exist: '.$bigMapFile."\r\n");
    }
}