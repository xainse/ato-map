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

for ($i = 0; $i < 7; $i++) {

    $timestamp = $weekAgo + ONE_DAY*$i;

    $bigMapFile = getFilenameOnDiskBig($timestamp);
    $smlMapFile = getFilenameOnDiskSml($timestamp);

    if (!file_exists(PATH_SAVE.$bigMapFile)){

        $sourceMapFile = getLinkToSourceFile($timestamp);

        copy ($sourceMapFile, PATH_SAVE.$bigMapFile);
        resize(SML_IMG_WIDTH, PATH_SAVE.$smlMapFile, PATH_SAVE.$bigMapFile);
        wln('Save img: '.$bigMapFile);
    } else {
        wln('File exist: '.$bigMapFile);
    }
}