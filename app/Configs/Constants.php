<?php

namespace App\Configs;

class Constants{

    const T_PATH = "http://192.168.1.110/sites/sites/turn8js/";

    public static function debug($var, ...$vars){
        echo '<pre>'.var_dump($var);
        foreach ($vars as $v) echo var_dump($vars);
        echo '</pre>';
    }
    
}
