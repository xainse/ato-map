<?php
/**
 * Created by PhpStorm.
 * User: Asus
 * Date: 06.11.2016
 * Time: 11:17
 */

require "src/lib.php";

//verifyFileSutability("http://mediarnbo.org/wp-content/uploads/2016/10/11-10-1.jpg");
//$url = "http://mediarnbo.org/wp-content/uploads/2016/10/11-10-1.jpg";
$url = "http://mediarnbo.org/wp-content/uploads/2016/10/30-10.jpg";
$dest = 'e:\OpenServer\domains\ato-map.dev\img\manually\big-2016-10-30.jpg';
//$file = 'e:\OpenServer\domains\ato-map.dev\img\manually\test.txt';



//if (file_exists($file)) wln('File exist');
//else wln('file doesn\'t exist');

if(!@copy($url, $dest))
{
    $errors = error_get_last();
    wln($errors);
    echo "COPY ERROR: ".$errors['type'];
    echo "<br />\n".$errors['message'];
} else {
    echo "File copied from remote!";
}

?>

<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="shortcut icon" href="img/app/favicon.ico" />
    <title>Карта зони АТО по інформації РНБО України</title>

</head>
<body>

</body>
</html>