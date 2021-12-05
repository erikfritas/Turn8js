<?php

namespace App\Utils;

use App\Configs\Constants;

class View extends TemplateEngine{

    /**
     * Verifica se a view existe
     * Retorna a view caso ela exista ou um erro (em string) caso contrário
     * 
     * @param string $view
     * @return string
     */
    public static function is_view($view){
        $file = __DIR__ . "/../../resources/view/$view";

        if (file_exists($file) && file_get_contents($file)){
            return file_get_contents($file);
        } else return "ERROR: This view ($view) not exists";
    }

    /**
     * Retorna a view com as keys já substituídas
     * 
     * @param string $view
     * @param array $keys = []
     * @return string
     */
    public static function render($view, $keys=[], $contents){
        $file = self::is_view($view);

        $keys = array_merge($keys, ['T_PATH' => Constants::T_PATH]);

        foreach ($keys as $key => $value)
            $file = str_replace("{{ $key }}", $value, $file);

        foreach ($contents as $key => $value)
            $file = str_replace($key, $value, $file);

        //Constants::debug($content);

        return $file;
    }

}
