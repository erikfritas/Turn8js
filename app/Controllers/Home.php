<?php

namespace App\Controllers;

use stdClass;

class Home extends Pages{
    
    public static function index(){

        $game1 = new stdClass;
        $game1->url = "cards-revolution";
        $game1->title = "Cards Revolution";
        $game1->description = "Lorem ipsum dolor sit amet.";
        $game1->stars = "5";
        $game1->mode = "offline";

        $game2 = new stdClass;
        $game2->url = "cards-revolution-2";
        $game2->title = "Cards Revolution 2";
        $game2->description = "Lorem ipsum dolor sit amet.";
        $game2->stars = "5";
        $game2->mode = "online";

        $games = [
            $game1,
            $game2,
            $game2
        ];

        return self::getPage('home', ['games' => $games]);

    }

}

