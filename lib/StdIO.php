<?php

class StdIO {
    protected $fp;

    public function __construct($fp) {
        $this->fp = $fp;
    }

    public function getIn() {
        return fgets($this->fp);
    }
    public function getInArray() {
        return explode(' ', rtrim($this->getIn()));
    }
    public function outPut($data) {
        echo $data;
    }
    public function outPutArray(array $array) {
        $this->outPut(implode(' ', $array) . PHP_EOL);
    }
}
