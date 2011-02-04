<?php defined('SYSPATH') OR die('No direct access allowed.');

/* NOTE: You must have the FirePHP library on your include path */
$libPath = dirname(__FILE__);

$includePath = explode(PATH_SEPARATOR, get_include_path());
if(!in_array($libPath, $includePath)) {
    array_unshift($includePath, $libPath);
    set_include_path(implode(PATH_SEPARATOR, $includePath));
}

define('INSIGHT_CONFIG_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . 'package.json');
require_once('FirePHP/Init.php');