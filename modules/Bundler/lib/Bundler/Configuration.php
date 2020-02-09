<?php

namespace Bundler;

class Configuration {

    static $bundles = [];
    static $developEnabled = [];

    static function addBundle($name,$path,$entry_point) {
        self::$bundles[] = ['name'=>$name,'path'=>$path,'entry_point'=>$entry_point];
    }

    static function developBundle() {
        foreach (func_get_args() as $arg) {
            self::$developEnabled[] = $arg;
        }
    }
}