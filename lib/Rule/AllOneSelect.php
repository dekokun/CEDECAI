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
        $resultHeroines = [];
        $maxHeroines = $heroines->getMaxEnthusiasmHeroines();
        $selectedHeroine = $maxHeroines->getRandomHeroine();
        foreach($turn->dayIter() as $_) {
            $resultHeroines[] = $selectedHeroine;
        }
        return new \Heroines($resultHeroines);
    }
}
