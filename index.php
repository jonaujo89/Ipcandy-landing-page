<?php

error_reporting(E_ALL);

define('BINGO_PATH',realpath(__DIR__.'/lib/bingo'));
require_once BINGO_PATH . "/loader.php";

\Bingo\Config::loadFile('config',INDEX_DIR.'/config.php');

\Bingo\Configuration::$applicationMode = in_array($_SERVER['HTTP_HOST'],\Bingo\Config::get('config','domain')) ? 'production' : 'development';
\Bingo\Configuration::$locale = (explode(".", $_SERVER['HTTP_HOST'])[0]=='en') ? 'en_EN' : 'ru_RU';

\Bingo\Configuration::addModulePath(INDEX_DIR."/modules");
\Bingo\Configuration::addModules('Auth','CMS');
\Bingo\Configuration::addModules('LPCandy','LPExtra');

\Bingo\Configuration::addDbConnection('localhost','boomyjee_lpcandy_new','boomyjee','jeemyboo');

\CMS\Configuration::$log_errors = true;
Auth\Configuration::$salt = "gg556dfgh_lpcandy_salt";

\Bingo\Template::addIncludePath('themes/default',INDEX_DIR."/view",INDEX_URL."/view");
\Bingo\Template::addIncludePath('',BINGO_PATH."/template",INDEX_URL."/lib/bingo/template");

\Bingo\Bingo::getInstance()->run();