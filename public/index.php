<?php

use Dotenv\Dotenv;

require "../vendor/autoload.php";
$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->safeLoad();
require "../src/routes.php";
