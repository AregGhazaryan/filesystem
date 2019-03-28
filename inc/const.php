<?php
//server url include, this fixes the issue where the application is located inside the folder and on every redirect it gets out from its core folder
$string = $_SERVER["REQUEST_URI"];
$plorp = substr(strrchr($string,'/'), 1);
$string = substr($string, 0, - strlen($plorp));
define("URL", $string);
