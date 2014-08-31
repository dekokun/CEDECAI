<?php

require_once(__DIR__ . '/vendor/autoload.php');

class Measure {
    private $times = [];
    private $beforeTime = 0;

    function __construct() {
       $this->beforeTime = microtime(true);
    }

    function measure($label) {
        if (!isset($this->times[$label])) {
            $this->times[$label] = 0;
        }
        $now = microtime(true);
        $this->times[$label] += $now - $this->beforeTime;
        $this->beforeTime = $now;
    }

    function outPut() {
        asort($this->times);
        logging($this->times);
    }

}
function logging($message) {
    $message = var_export($message, true) . PHP_EOL;
    fputs(STDERR, $message);
}
if (isset($argv[1]) && $argv[1] == 'hoge') {
    function __xhprof_save()
    {
        $data = xhprof_disable();
        $runs = new XHProfRuns_Default('/tmp');
        $runs->save_run($data, 'hoge');
    }

    xhprof_enable();
    register_shutdown_function('__xhprof_save');
}
logging('start');
$game = new Game();
logging('main');
$game->main();
logging('end');
