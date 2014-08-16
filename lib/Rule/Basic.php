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
                $difference = $heroine->getMinRevealedScoreExcludePlayer()
                    - $heroine->getPlayerScore();
                $wantGetPoint = $difference + 2;
                if ($wantGetPoint <= 0) {
                    continue;
                }
                for ($i = 0;
                     $i < $wantGetPoint;
                     $i++) {
                    $resultHeroines[] = $heroine;
                }

            }
        } else {
            foreach($heroines->getSortByEnthusiasmHeroines(SORT_DESC) as $heroine) {
                if (count($resultHeroines) >= $turn->nextDayCount()) {
                    return new \Heroines($resultHeroines);
                }
                $difference = $heroine->getMaxRevealedScoreExcludePlayer()
                    - $heroine->getPlayerScore();
                $wantGetPoint = $difference + 2;
                if ($wantGetPoint <= 0) {
                    continue;
                }
                for ($i = 0;
                // 休日は二倍
                     $i * 2 < $wantGetPoint;
                     $i++) {
                    $resultHeroines[] = $heroine;
                }

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
                logging('RANDOM !!!');
                $resultHeroines[] = $heroines->getRandomHeroine();
            }
        }
        return $resultHeroines;
    }
}
