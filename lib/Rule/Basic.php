<?php

namespace Rule;

class Basic extends Rule {
    protected function doEvaluate(\Heroines $heroines, \Turn $turn) {
        return 1;
    }
    public function result(\Heroines $heroines, \Turn $turn) {
        $resultHeroines = [];
        if ($turn->nextTurnIsWeekDay()) {
            foreach($heroines->getSortByEnthusiasmHeroines(SORT_DESC) as $heroine) {
                if (count($resultHeroines) >= $turn->nextDayCount()) {
                    return new \Heroines($resultHeroines);
                }
                if ($heroine->getMaxRevealedScoreExcludePlayer()
                    < $heroine->getPlayerScore()
                ) {
                    continue;
                }
                $difference = $heroine->getMaxRevealedScoreExcludePlayer()
                    - $heroine->getPlayerScore();
                for ($i = 0;
                     // 1点多くする
                     $i < $difference + 1;
                     $i++) {
                    logging($heroine->getIndex());
                    $resultHeroines[] = $heroine;
                }

            }
        } else {
            foreach($turn->dayIter() as $_) {
                $resultHeroines[] = $heroines->getRandomHeroine();
            }
        }
        return new \Heroines($this->paddingHeroines($heroines, $resultHeroines, $turn));
    }

    private function paddingHeroines(\Heroines $heroines, array $resultHeroines, \Turn $turn) {
        if (count($resultHeroines) > $turn->nextDayCount()) {
            return array_slice($resultHeroines, 0, $turn->nextDayCount());
        }
        if (count($resultHeroines) < $turn->nextDayCount()) {
            $difference = count($resultHeroines) - $turn->nextDayCount();
            for ($i = 0; $i < $difference; $i++) {
                $resultHeroines[] = $heroines->getRandomHeroine();
            }
        }
        return $resultHeroines;
    }
}
