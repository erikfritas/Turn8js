<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

use App\Configs\Constants;
use App\Controllers\Home;

/* Testar todas as constantes
echo Constants::T_PATH;
*/

echo Home::index();
