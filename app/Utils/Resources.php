<?php

namespace App\Utils;

use App\Configs\Constants;

class Resources{

    public static function is_dir_exists($local){
        $dir = __DIR__ . "/../../resources/$local";

        if (scandir($dir)) return scandir($dir);
        else return ["msg" => "ERROR: This file ($dir) not exists"];
    }

    public static function getCSS($page){
        $dir = self::is_dir_exists("css/$page");
        array_shift($dir);
        array_shift($dir);

        $files = '';
        foreach ($dir as $value)
            $files .= "<link rel=\"stylesheet\" href=\"". Constants::T_PATH ."resources/css/$page/$value\" >";

        return $files;
    }

    public static function getJS($page){
        $dir = self::is_dir_exists("js/$page");
        array_shift($dir);
        array_shift($dir);

        $files = '';
        foreach ($dir as $value)
            $files .= "<script src=\"".Constants::T_PATH."resources/js/$page/$value\"></script>";

        return $files;
    }

    public static function getfiles($page){
        return ['css' => self::getCSS($page), 'js' => self::getJS($page)];
    }

}
