<?php

error_reporting(E_ALL);

define('BINGO_PATH',realpath(__DIR__.'/lib/bingo'));
require_once BINGO_PATH . "/loader.php";

\Bingo\Configuration::$applicationMode = 'development';
\Bingo\Configuration::$locale = 'ru_RU';

// some comment

\Bingo\Configuration::addModulePath(INDEX_DIR."/modules");
\Bingo\Configuration::addModules('Auth','CMS');
\Bingo\Configuration::addModules('LPCandy');

\Bingo\Configuration::addDbConnection('localhost','boomyjee_lpcandy_new','boomyjee','jeemyboo');

\CMS\Configuration::$log_errors = true;


\Bingo\Template::addIncludePath('themes/default',INDEX_DIR."/view",INDEX_URL."/view");
\Bingo\Template::addIncludePath('',BINGO_PATH."/template",INDEX_URL."/lib/bingo/template");

\Bingo\Bingo::getInstance()->run();