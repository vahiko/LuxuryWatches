<?php

define("DEBUG", 1); //debug mode 1, production mode 0
define("ROOT", dirname(__DIR__)); //root directory of the project
define("WWW", ROOT."/public"); // public directory of the project
define("APP", ROOT."/app"); // app directory
define("CORE", ROOT."/vendor/ishop/core"); //core directory
define("LIBS", ROOT."/vendor/ishop/core/libs"); // libs directory
define("CACHE", ROOT."/tmp/cache"); // cache directory
define("CONF", ROOT."/config"); // config directory
define("LAYOUT", "watches"); // default layout of the project

$app_path = "http://{$_SERVER['HTTP_HOST']}";
define("PATH", $app_path);
define("ADMIN", PATH."/admin");

require_once ROOT.'/vendor/autoload.php';
