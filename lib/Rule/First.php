<?php

namespace Rule;

/**
 * Class First
 * 平日のことしか想定していないので注意
 * MonteCarloの試行回数を大量に増やして実施した内容をプログラムに起こしたもの
 * @package Rule
 */
class First extends Rule {
    protected function doEvaluate(\Heroines $heroines, \Turn $turn) {
        if ($turn->getNextTurn() === 1) {
            return 100;
        }
        return 0;
    }
    public function result(\Heroines $heroines, \Turn $turn) {
        $maxHeroines = $heroines->getMaxEnthusiasmHeroines();
        if (($maxHeroineCount = count($maxHeroines)) > 2) {
            // 熱狂度が最大のユーザがターン数以上いた場合はそのまま1人ずつ割り振って終了
            if ($maxHeroineCount >= \Turn::WEEKDAY_COUNT) {
                return $heroines->getRandomHeroines(\Turn::WEEKDAY_COUNT);
            }
            return new \Heroines(
                array_merge($maxHeroines->toArray(),
                    $maxHeroines->getRandomHeroines(
                        \Turn::WEEKDAY_COUNT - $maxHeroineCount
                    )->toArray()
                )
            );
        }
        if (($maxHeroineCount = count($maxHeroines)) === 2) {
            return new \Heroines(
                array_merge($maxHeroines->toArray(),
                    $maxHeroines->getRandomHeroines(2)->toArray(),
                    $maxHeroines->getRandomHeroines(1)->toArray()
                )
            );
        }

        // 以下、最大のヒロインが一人だけの場合
        $maxHeroine = $heroines->getMaxEnthusiasmHeroines()->getRandomHeroine();
        $selectedHeroines = array_fill(0, 3, $maxHeroine);
        $secondEnthusiasmHeroines = $heroines->getSecondEnthusiasmHeroines();
        if ($heroines->getMaxEnthusiasm()
            - $secondEnthusiasmHeroines->getRandomHeroine()->getEnthusiasm() === 1) {
            array_push(
                $selectedHeroines,
                $secondEnthusiasmHeroines->getRandomHeroine(),
                $secondEnthusiasmHeroines->getRandomHeroine()
            );
            return new \Heroines($selectedHeroines);
        }
        array_push(
            $selectedHeroines,
            $maxHeroine,
            $maxHeroine
        );
        return new \Heroines($selectedHeroines);
    }
}
