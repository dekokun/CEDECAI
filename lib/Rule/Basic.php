<?php

namespace Rule;

class Basic extends Rule {
    protected function doEvaluate(\Heroines $heroines, \Turn $turn) {
        return 1;
    }
    public function result(\Heroines $heroines, \Turn $turn) {
        $heroineNums = [];
        foreach($turn->dayIter() as $_) {
            $heroineNums[] = mt_rand(0, count($heroines));
        }
        return $heroineNums;
    }
}
