<?php

namespace Rule;

class Basic extends Rule {
    protected function doEvaluate(\Heroines $heroines, \Turn $turn) {
        return 1;
    }
    public function result(\Heroines $heroines, \Turn $turn) {
        $resultHeroines = [];
        if ($turn->nextTurnIsWeekDay()) {
            foreach($turn->dayIter() as $_) {
                $resultHeroines[] = $heroines->getRandomHeroine();
            }
        } else {
            foreach($turn->dayIter() as $_) {
                $resultHeroines[] = $heroines->getRandomHeroine();
            }
        }
        return new \Heroines($resultHeroines);
    }
}
