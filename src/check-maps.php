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

$weekAgo = time() - ONE_DAY*7;

print_r(">>>file: check-maps.php >>> \r\n <br>");
print_r("ATO MAP. Сheck downloaded images"."\r\n <br>");

for ($i = 0; $i < 7; $i++) {

    $timestamp = $weekAgo + ONE_DAY*$i;

    $bigMapFile = getFilenameOnDiskBig($timestamp);
    $smlMapFile = getFilenameOnDiskSml($timestamp);

    //print_r(PATH_SAVE.$bigMapFile . "\n");

    if (!file_exists(PATH_SAVE.$bigMapFile)){

        $sourceMapFile = getLinkToSourceFile($timestamp);

        copy ($sourceMapFile, PATH_SAVE.$bigMapFile);

        resize(SML_IMG_WIDTH, PATH_SAVE.$smlMapFile, PATH_SAVE.$bigMapFile);
        print_r($i.'. Save img: '.$bigMapFile ."\n <br>");
    } else {
        print_r($i.'. File exist: '.$bigMapFile ."\n <br>");
    }
}