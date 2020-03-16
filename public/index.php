<?php

error_reporting(E_ALL);

define('APP_DIR',realpath(__DIR__.'/..'));
define('BINGO_PATH',realpath(__DIR__.'/../bingo'));
require_once BINGO_PATH . "/loader.php";

\Bingo\Config::loadFile('config',APP_DIR.'/config.php');

\Bingo\Configuration::$applicationMode = in_array($_SERVER['HTTP_HOST'],\Bingo\Config::get('config','domain')) ? 'production' : 'development';
\Bingo\Configuration::$locale = (explode(".", $_SERVER['HTTP_HOST'])[0]=='en') ? 'en_EN' : 'ru_RU';

\Bingo\Configuration::addModulePath(APP_DIR."/modules");
\Bingo\Configuration::addModules('Auth','CMS');
\Bingo\Configuration::addModules('Bundler','LPCandy');

//\Bundler\Configuration::addBundle("lpcandy","assets/lpcandy.min.js","../front/lpcandy/makefile.tea");
\Bundler\Configuration::addBundle("editor","assets/editor.min.js","../front/editor/app.js");

require APP_DIR."/db.php";

\CMS\Configuration::$log_errors = true;
\Auth\Configuration::$salt = "gg556dfgh_lpcandy_salt";

\Bingo\Template::addIncludePath('',BINGO_PATH."/template","https://uxcandy.com/~boomyjee/bingo/template");

\Bingo\Bingo::getInstance()->run();