<?php

define('BINGO_PATH',realpath(__DIR__.'/lib/bingo'));
require_once BINGO_PATH . "/loader.php";

\Bingo\Configuration::$applicationMode = 'development';
\Bingo\Configuration::$locale = 'ru_RU';

\Bingo\Configuration::addModulePath(INDEX_DIR."/modules");
\Bingo\Configuration::addModules('Auth','CMS','Layout','Meta','FileManager');
\Bingo\Configuration::addModules('LPCandy');

\Bingo\Configuration::addDbConnection('localhost','boomyjee_lpcandy_new','boomyjee','jeemyboo');

\Bingo\Template::addIncludePath('themes/default',INDEX_DIR."/view",INDEX_URL."/view");
\Bingo\Template::addIncludePath('',BINGO_PATH."/template",INDEX_URL."/lib/bingo/template");

\Bingo\Bingo::getInstance()->run();