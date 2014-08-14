<?php

namespace Rule;

class AllOneSelect extends Rule {
    protected function doEvaluate(\Heroines $heroines, \Turn $turn) {
        logging($turn->getNextTurn());
        if ($turn->getNextTurn() === 1) {
            return 100;
        }
        return 0;
    }
    public function result(\Heroines $heroines, \Turn $turn) {
        $heroineNums = [];
        $maxHeroines = $heroines->getMaxEnthusiasmHeroines();
        $selectedHeroine = $maxHeroines->getRandomHeroine();
        foreach($turn->dayIter() as $_) {
            $heroineNums[] = $selectedHeroine->getIndex();
        }
        return $heroineNums;
    }
}
