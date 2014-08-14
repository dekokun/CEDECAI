<?php

namespace Rule;

class Basic extends Rule {
    protected function doEvaluate(\Heroines $heroines, \Turn $turn) {
        return 1;
    }
    public function result(\Heroines $heroines, \Turn $turn) {
        $heroineNums = [];
        if ($turn->nextTurnIsWeekDay()) {
            foreach($turn->dayIter() as $_) {
                $heroineNums[] = $heroines->getRandomHeroine()->getIndex();
            }
        }
        return $heroineNums;
    }
}
