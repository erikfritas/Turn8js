<?php

namespace App\Utils;

use App\Configs\Constants;
use App\Utils\View;
use App\Utils\Resources;

class TemplateEngine{
    private static function is_section($file){
        $section_tags = [];
        $section_open_tags = explode('@section(\'', $file);
        array_shift($section_open_tags);

        foreach ($section_open_tags as $v1){
            $v2 = explode("')", $v1)[0];
            $v_content = explode("@endsection", explode("')", $v1)[1])[0];

            if (strlen($v2) > 3){
                if (strpos($v2, "', '")){
                    $v3 = explode("', '", $v2);
                    $section_tags = array_merge($section_tags, [$v3[0] => $v3[1]]);
                }
                else $section_tags =
                array_merge($section_tags, [$v2 => $v_content]);
            }
        }

        return $section_tags;
    }

    private static function is_foreach($file, $keys){
        $foreachs = explode('@foreach ($', $file);
        array_shift($foreachs);

        $foreachs_returns = [];

        // loop for all @foreach in this file
        foreach ($foreachs as $key => $content_f) {
            $foreach_var = explode(' ', explode('@foreach ($', $file)[$key+1])[0];
            $foreach_value = explode(')', explode(' as $', explode('@foreach ($'.$foreach_var, $file)[$key+1])[1])[0];
            $foreach_content =
            explode('@endforeach', explode('@foreach ($'.$foreach_var.' as $'."$foreach_value)", $file)[$key+1])[0];
            $nforeach_content = $foreach_content;
            $foreach_all =
            '@foreach ($'.$foreach_var.explode('@endforeach', explode('@foreach ($'.$foreach_var, $file)[$key+1])[0].'@endforeach';

            if (in_array($foreach_var, array_keys($keys))){
                $f_content_keys = [];

                foreach (explode('{{ ', $foreach_content) as $v)
                    array_push($f_content_keys, explode(' }}', $v)[0]);
                array_shift($f_content_keys);

                $new_f_content = '';
                foreach ($keys[$foreach_var] as $value) {
                    foreach ($f_content_keys as $v) {
                        $v_keys = explode('$'.$foreach_value.'->', $v)[1];
                        $nforeach_content = str_replace("{{ $v }}", $value->$v_keys, $nforeach_content);
                    }
                    $new_f_content .= $nforeach_content;
                    $nforeach_content = $foreach_content;
                }

                $foreachs_returns = array_merge([$foreach_all => $new_f_content], $foreachs_returns);
            } else return ['error_msg' => "ERROR: var ($foreach_value) isn't in keys!"];
        }

        return $foreachs_returns;
    }

    private static function is_template($layout, $file, $view, $keys){
        if (file_exists(__DIR__."/../../resources/view/layouts/$layout")){
            $foreach_tags = self::is_foreach($file, $keys);
            $section_tags = self::is_section($file);

            //Constants::debug($foreach_tags);

            return View::render(
                "layouts/$layout",
                array_merge($section_tags, Resources::getfiles(str_replace('.html', '', $view))),
                $foreach_tags
            );
        } else return "ERROR: This layout ($layout) not exists in (".Constants::T_PATH."resources/view/layouts/$layout)";
    }

    public static function template($view, $keys=[]){
        $file = View::is_view($view);

        $keys = array_merge($keys, ['T_PATH' => Constants::T_PATH]);

        foreach ($keys as $key => $value) if (gettype($value) != 'array')
            $file = str_replace("{{ $key }}", $value, $file);

        $layout = explode('\')', explode('@extends(\'', $file)[1])[0] . ".html";

        return self::is_template($layout, $file, $view, $keys);
    }
}

