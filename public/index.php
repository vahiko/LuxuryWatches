<?php

require_once dirname(__DIR__).'/config/init.php';
require_once LIBS.'/functions.php';

new \ishop\App();
//debug(\ishop\App::$app->getProperties());

throw new Exception("Page not available", 404);