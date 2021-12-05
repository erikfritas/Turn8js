<?php

namespace App\Controllers;

use App\Utils\View;
use App\Configs\Constants;

class Pages{

    public static function getPage($view, $keys=[]){

        return View::template("$view.html", $keys);
    }

}
