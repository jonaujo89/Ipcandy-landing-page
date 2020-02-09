<?php

error_reporting(E_ALL);

define('BINGO_PATH',realpath(__DIR__.'/lib/bingo'));
require_once BINGO_PATH . "/loader.php";

\Bingo\Config::loadFile('config',INDEX_DIR.'/config.php');

\Bingo\Configuration::$applicationMode = in_array($_SERVER['HTTP_HOST'],\Bingo\Config::get('config','domain')) ? 'production' : 'development';
\Bingo\Configuration::$locale = (explode(".", $_SERVER['HTTP_HOST'])[0]=='en') ? 'en_EN' : 'ru_RU';

\Bingo\Configuration::addModulePath(INDEX_DIR."/modules");
\Bingo\Configuration::addModules('Auth','CMS');
\Bingo\Configuration::addModules('Bundler','LPCandy','LPExtra');

\Bundler\Configuration::addBundle("lpcandy","view/assets/lpcandy.min.js","view/assets/tea/makefile.tea");
\Bundler\Configuration::addBundle("editor","view/assets/editor.min.js","view/editor/editor.js");
\Bundler\Configuration::addBundle("components","view/assets/components.min.js","view/editor/style/style.tea");

require __DIR__."/db.php";

\CMS\Configuration::$log_errors = true;
Auth\Configuration::$salt = "gg556dfgh_lpcandy_salt";

\Bingo\Template::addIncludePath('themes/default',INDEX_DIR."/view",INDEX_URL."/view");
\Bingo\Template::addIncludePath('',BINGO_PATH."/template",INDEX_URL."/lib/bingo/template");

\Bingo\Bingo::getInstance()->run();