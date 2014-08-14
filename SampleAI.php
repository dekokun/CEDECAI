<?php

require_once(__DIR__ . '/vendor/autoload.php');

function logging($message) {
    $message = var_export($message, true) . PHP_EOL;
    fputs(STDERR, $message);
    error_log($message, 3, '/tmp/hoge.log');
}

logging('start');
$game = new Game();
logging('main');
$game->main();
logging('end');
