<?php

namespace Rule;

class MonteCarloFirstHalf extends MonteCarlo
{
    const WEEKDAY_TRIAL_RATE = 50;
    protected function doEvaluate(\Heroines $heroines, \Turn $turn)
    {
        if ($turn->getNextTurn() < 4) {
            return 50;
        }
        return 0;
    }

    /**
     * @param \Turn $turn
     * @return array
     */
    public function myPointChoiceCombination(\Turn $turn)
    {
        static $combies;
        if ($turn->nextTurnIsHoliday()) {
            if (! isset($combies[\Turn::HOLIDAY])) {
                $combies[\Turn::HOLIDAY] = [
                    [4, 0, 0, 0, 0, 0, 0, 0],
//                    [2, 2, 0, 0, 0, 0, 0, 0],
//                    [2, 0, 2, 0, 0, 0, 0, 0],
//                    [2, 0, 0, 2, 0, 0, 0, 0],
//                    [2, 0, 0, 0, 2, 0, 0, 0],
//                    [2, 0, 0, 0, 0, 2, 0, 0],
//                    [2, 0, 0, 0, 0, 0, 2, 0],
//                    [2, 0, 0, 0, 0, 0, 0, 2],
                    [0, 4, 0, 0, 0, 0, 0, 0],
//                    [0, 2, 2, 0, 0, 0, 0, 0],
//                    [0, 2, 0, 2, 0, 0, 0, 0],
//                    [0, 2, 0, 0, 2, 0, 0, 0],
//                    [0, 2, 0, 0, 0, 2, 0, 0],
//                    [0, 2, 0, 0, 0, 0, 2, 0],
//                    [0, 2, 0, 0, 0, 0, 0, 2],
                    [0, 0, 4, 0, 0, 0, 0, 0],
//                    [0, 0, 2, 2, 0, 0, 0, 0],
//                    [0, 0, 2, 0, 2, 0, 0, 0],
//                    [0, 0, 2, 0, 0, 2, 0, 0],
//                    [0, 0, 2, 0, 0, 0, 2, 0],
//                    [0, 0, 2, 0, 0, 0, 0, 2],
                    [0, 0, 0, 4, 0, 0, 0, 0],
//                    [0, 0, 0, 2, 2, 0, 0, 0],
//                    [0, 0, 0, 2, 0, 2, 0, 0],
//                    [0, 0, 0, 2, 0, 0, 2, 0],
//                    [0, 0, 0, 2, 0, 0, 0, 2],
                    [0, 0, 0, 0, 4, 0, 0, 0],
//                    [0, 0, 0, 0, 2, 2, 0, 0],
//                    [0, 0, 0, 0, 2, 0, 2, 0],
//                    [0, 0, 0, 0, 2, 0, 0, 2],
                    [0, 0, 0, 0, 0, 4, 0, 0],
//                    [0, 0, 0, 0, 0, 2, 2, 0],
//                    [0, 0, 0, 0, 0, 2, 0, 2],
                    [0, 0, 0, 0, 0, 0, 4, 0],
//                    [0, 0, 0, 0, 0, 0, 2, 2],
                    [0, 0, 0, 0, 0, 0, 0, 4],
                ];
            }
            return $combies[\Turn::HOLIDAY];
        }
        if (! isset($combies[\Turn::WEEKDAY])) {
            $combies[\Turn::WEEKDAY] = [
                [5, 0, 0, 0, 0, 0, 0, 0],
                [4, 1, 0, 0, 0, 0, 0, 0],
                [4, 0, 1, 0, 0, 0, 0, 0],
                [4, 0, 0, 1, 0, 0, 0, 0],
                [4, 0, 0, 0, 1, 0, 0, 0],
                [4, 0, 0, 0, 0, 1, 0, 0],
                [4, 0, 0, 0, 0, 0, 1, 0],
                [4, 0, 0, 0, 0, 0, 0, 1],
                [3, 2, 0, 0, 0, 0, 0, 0],
                [3, 1, 1, 0, 0, 0, 0, 0],
                [3, 1, 0, 1, 0, 0, 0, 0],
                [3, 1, 0, 0, 1, 0, 0, 0],
                [3, 1, 0, 0, 0, 1, 0, 0],
                [3, 1, 0, 0, 0, 0, 1, 0],
                [3, 1, 0, 0, 0, 0, 0, 1],
                [3, 0, 2, 0, 0, 0, 0, 0],
                [3, 0, 1, 1, 0, 0, 0, 0],
                [3, 0, 1, 0, 1, 0, 0, 0],
                [3, 0, 1, 0, 0, 1, 0, 0],
                [3, 0, 1, 0, 0, 0, 1, 0],
                [3, 0, 1, 0, 0, 0, 0, 1],
                [3, 0, 0, 2, 0, 0, 0, 0],
                [3, 0, 0, 1, 1, 0, 0, 0],
                [3, 0, 0, 1, 0, 1, 0, 0],
                [3, 0, 0, 1, 0, 0, 1, 0],
                [3, 0, 0, 1, 0, 0, 0, 1],
                [3, 0, 0, 0, 2, 0, 0, 0],
                [3, 0, 0, 0, 1, 1, 0, 0],
                [3, 0, 0, 0, 1, 0, 1, 0],
                [3, 0, 0, 0, 1, 0, 0, 1],
                [3, 0, 0, 0, 0, 2, 0, 0],
                [3, 0, 0, 0, 0, 1, 1, 0],
                [3, 0, 0, 0, 0, 1, 0, 1],
                [3, 0, 0, 0, 0, 0, 2, 0],
                [3, 0, 0, 0, 0, 0, 1, 1],
                [3, 0, 0, 0, 0, 0, 0, 2],
                [2, 3, 0, 0, 0, 0, 0, 0],
                [2, 2, 1, 0, 0, 0, 0, 0],
                [2, 2, 0, 1, 0, 0, 0, 0],
                [2, 2, 0, 0, 1, 0, 0, 0],
                [2, 2, 0, 0, 0, 1, 0, 0],
                [2, 2, 0, 0, 0, 0, 1, 0],
                [2, 2, 0, 0, 0, 0, 0, 1],
                [2, 1, 2, 0, 0, 0, 0, 0],
                [2, 1, 1, 1, 0, 0, 0, 0],
                [2, 1, 1, 0, 1, 0, 0, 0],
                [2, 1, 1, 0, 0, 1, 0, 0],
                [2, 1, 1, 0, 0, 0, 1, 0],
                [2, 1, 1, 0, 0, 0, 0, 1],
                [2, 1, 0, 2, 0, 0, 0, 0],
                [2, 1, 0, 1, 1, 0, 0, 0],
                [2, 1, 0, 1, 0, 1, 0, 0],
                [2, 1, 0, 1, 0, 0, 1, 0],
                [2, 1, 0, 1, 0, 0, 0, 1],
                [2, 1, 0, 0, 2, 0, 0, 0],
                [2, 1, 0, 0, 1, 1, 0, 0],
                [2, 1, 0, 0, 1, 0, 1, 0],
                [2, 1, 0, 0, 1, 0, 0, 1],
                [2, 1, 0, 0, 0, 2, 0, 0],
                [2, 1, 0, 0, 0, 1, 1, 0],
                [2, 1, 0, 0, 0, 1, 0, 1],
                [2, 1, 0, 0, 0, 0, 2, 0],
                [2, 1, 0, 0, 0, 0, 1, 1],
                [2, 1, 0, 0, 0, 0, 0, 2],
                [1, 4, 0, 0, 0, 0, 0, 0],
                [1, 3, 1, 0, 0, 0, 0, 0],
                [1, 3, 0, 1, 0, 0, 0, 0],
                [1, 3, 0, 0, 1, 0, 0, 0],
                [1, 3, 0, 0, 0, 1, 0, 0],
                [1, 3, 0, 0, 0, 0, 1, 0],
                [1, 3, 0, 0, 0, 0, 0, 1],
                [1, 2, 2, 0, 0, 0, 0, 0],
                [1, 2, 1, 1, 0, 0, 0, 0],
                [1, 2, 1, 0, 1, 0, 0, 0],
                [1, 2, 1, 0, 0, 1, 0, 0],
                [1, 2, 1, 0, 0, 0, 1, 0],
                [1, 2, 1, 0, 0, 0, 0, 1],
                [1, 2, 0, 2, 0, 0, 0, 0],
                [1, 2, 0, 1, 1, 0, 0, 0],
                [1, 2, 0, 1, 0, 1, 0, 0],
                [1, 2, 0, 1, 0, 0, 1, 0],
                [1, 2, 0, 1, 0, 0, 0, 1],
                [1, 2, 0, 0, 2, 0, 0, 0],
                [1, 2, 0, 0, 1, 1, 0, 0],
                [1, 2, 0, 0, 1, 0, 1, 0],
                [1, 2, 0, 0, 1, 0, 0, 1],
                [1, 2, 0, 0, 0, 2, 0, 0],
                [1, 2, 0, 0, 0, 1, 1, 0],
                [1, 2, 0, 0, 0, 1, 0, 1],
                [1, 2, 0, 0, 0, 0, 2, 0],
                [1, 2, 0, 0, 0, 0, 1, 1],
                [1, 2, 0, 0, 0, 0, 0, 2],
                [1, 1, 3, 0, 0, 0, 0, 0],
                [1, 1, 2, 1, 0, 0, 0, 0],
                [1, 1, 2, 0, 1, 0, 0, 0],
                [1, 1, 2, 0, 0, 1, 0, 0],
                [1, 1, 2, 0, 0, 0, 1, 0],
                [1, 1, 2, 0, 0, 0, 0, 1],
                [1, 1, 1, 2, 0, 0, 0, 0],
                [1, 1, 1, 1, 1, 0, 0, 0],
                [1, 1, 1, 1, 0, 1, 0, 0],
                [1, 1, 1, 1, 0, 0, 1, 0],
                [1, 1, 1, 1, 0, 0, 0, 1],
                [1, 1, 1, 0, 2, 0, 0, 0],
                [1, 1, 1, 0, 1, 1, 0, 0],
                [1, 1, 1, 0, 1, 0, 1, 0],
                [1, 1, 1, 0, 1, 0, 0, 1],
                [1, 1, 1, 0, 0, 2, 0, 0],
                [1, 1, 1, 0, 0, 1, 1, 0],
                [1, 1, 1, 0, 0, 1, 0, 1],
                [1, 1, 1, 0, 0, 0, 2, 0],
                [1, 1, 1, 0, 0, 0, 1, 1],
                [1, 1, 1, 0, 0, 0, 0, 2],
                [1, 1, 0, 3, 0, 0, 0, 0],
                [1, 1, 0, 2, 1, 0, 0, 0],
                [1, 1, 0, 2, 0, 1, 0, 0],
                [1, 1, 0, 2, 0, 0, 1, 0],
                [1, 1, 0, 2, 0, 0, 0, 1],
                [1, 1, 0, 1, 2, 0, 0, 0],
                [1, 1, 0, 1, 1, 1, 0, 0],
                [1, 1, 0, 1, 1, 0, 1, 0],
                [1, 1, 0, 1, 1, 0, 0, 1],
                [1, 1, 0, 1, 0, 2, 0, 0],
                [1, 1, 0, 1, 0, 1, 1, 0],
                [1, 1, 0, 1, 0, 1, 0, 1],
                [1, 1, 0, 1, 0, 0, 2, 0],
                [1, 1, 0, 1, 0, 0, 1, 1],
                [1, 1, 0, 1, 0, 0, 0, 2],
                [1, 1, 0, 0, 3, 0, 0, 0],
                [1, 1, 0, 0, 2, 1, 0, 0],
                [1, 1, 0, 0, 2, 0, 1, 0],
                [1, 1, 0, 0, 2, 0, 0, 1],
                [1, 1, 0, 0, 1, 2, 0, 0],
                [1, 1, 0, 0, 1, 1, 1, 0],
                [1, 1, 0, 0, 1, 1, 0, 1],
                [1, 1, 0, 0, 1, 0, 2, 0],
                [1, 1, 0, 0, 1, 0, 1, 1],
                [1, 1, 0, 0, 1, 0, 0, 2],
                [1, 1, 0, 0, 0, 3, 0, 0],
                [1, 1, 0, 0, 0, 2, 1, 0],
                [1, 1, 0, 0, 0, 2, 0, 1],
                [1, 1, 0, 0, 0, 1, 2, 0],
                [1, 1, 0, 0, 0, 1, 1, 1],
                [1, 1, 0, 0, 0, 0, 3, 0],
                [1, 1, 0, 0, 0, 0, 2, 1],
                [1, 1, 0, 0, 0, 0, 1, 2],
                [1, 1, 0, 0, 0, 0, 0, 3],
                [1, 0, 4, 0, 0, 0, 0, 0],
                [1, 0, 3, 1, 0, 0, 0, 0],
                [1, 0, 3, 0, 1, 0, 0, 0],
                [1, 0, 3, 0, 0, 1, 0, 0],
                [1, 0, 3, 0, 0, 0, 1, 0],
                [1, 0, 3, 0, 0, 0, 0, 1],
                [1, 0, 2, 2, 0, 0, 0, 0],
                [1, 0, 2, 1, 1, 0, 0, 0],
                [1, 0, 2, 1, 0, 1, 0, 0],
                [1, 0, 2, 1, 0, 0, 1, 0],
                [1, 0, 2, 1, 0, 0, 0, 1],
                [1, 0, 2, 0, 2, 0, 0, 0],
                [1, 0, 2, 0, 1, 1, 0, 0],
                [1, 0, 2, 0, 1, 0, 1, 0],
                [1, 0, 2, 0, 1, 0, 0, 1],
                [1, 0, 2, 0, 0, 2, 0, 0],
                [1, 0, 2, 0, 0, 1, 1, 0],
                [1, 0, 2, 0, 0, 1, 0, 1],
                [1, 0, 2, 0, 0, 0, 2, 0],
                [1, 0, 2, 0, 0, 0, 1, 1],
                [1, 0, 2, 0, 0, 0, 0, 2],
                [1, 0, 1, 3, 0, 0, 0, 0],
                [1, 0, 1, 2, 1, 0, 0, 0],
                [1, 0, 1, 2, 0, 1, 0, 0],
                [1, 0, 1, 2, 0, 0, 1, 0],
                [1, 0, 1, 2, 0, 0, 0, 1],
                [1, 0, 1, 1, 2, 0, 0, 0],
                [1, 0, 1, 1, 1, 1, 0, 0],
                [1, 0, 1, 1, 1, 0, 1, 0],
                [1, 0, 1, 1, 1, 0, 0, 1],
                [1, 0, 1, 1, 0, 2, 0, 0],
                [1, 0, 1, 1, 0, 1, 1, 0],
                [1, 0, 1, 1, 0, 1, 0, 1],
                [1, 0, 1, 1, 0, 0, 2, 0],
                [1, 0, 1, 1, 0, 0, 1, 1],
                [1, 0, 1, 1, 0, 0, 0, 2],
                [1, 0, 1, 0, 3, 0, 0, 0],
                [1, 0, 1, 0, 2, 1, 0, 0],
                [1, 0, 1, 0, 2, 0, 1, 0],
                [1, 0, 1, 0, 2, 0, 0, 1],
                [1, 0, 1, 0, 1, 2, 0, 0],
                [1, 0, 1, 0, 1, 1, 1, 0],
                [1, 0, 1, 0, 1, 1, 0, 1],
                [1, 0, 1, 0, 1, 0, 2, 0],
                [1, 0, 1, 0, 1, 0, 1, 1],
                [1, 0, 1, 0, 1, 0, 0, 2],
                [1, 0, 1, 0, 0, 3, 0, 0],
                [1, 0, 1, 0, 0, 2, 1, 0],
                [1, 0, 1, 0, 0, 2, 0, 1],
                [1, 0, 1, 0, 0, 1, 2, 0],
                [1, 0, 1, 0, 0, 1, 1, 1],
                [1, 0, 1, 0, 0, 1, 0, 2],
                [1, 0, 1, 0, 0, 0, 3, 0],
                [1, 0, 1, 0, 0, 0, 2, 1],
                [1, 0, 1, 0, 0, 0, 1, 2],
                [1, 0, 1, 0, 0, 0, 0, 3],
                [1, 0, 0, 4, 0, 0, 0, 0],
                [1, 0, 0, 3, 1, 0, 0, 0],
                [1, 0, 0, 3, 0, 1, 0, 0],
                [1, 0, 0, 3, 0, 0, 1, 0],
                [1, 0, 0, 3, 0, 0, 0, 1],
                [1, 0, 0, 2, 2, 0, 0, 0],
                [1, 0, 0, 2, 1, 1, 0, 0],
                [1, 0, 0, 2, 1, 0, 1, 0],
                [1, 0, 0, 2, 1, 0, 0, 1],
                [1, 0, 0, 2, 0, 2, 0, 0],
                [1, 0, 0, 2, 0, 1, 1, 0],
                [1, 0, 0, 2, 0, 1, 0, 1],
                [1, 0, 0, 2, 0, 0, 2, 0],
                [1, 0, 0, 2, 0, 0, 1, 1],
                [1, 0, 0, 2, 0, 0, 0, 2],
                [1, 0, 0, 1, 3, 0, 0, 0],
                [1, 0, 0, 1, 2, 1, 0, 0],
                [1, 0, 0, 1, 2, 0, 1, 0],
                [1, 0, 0, 1, 2, 0, 0, 1],
                [1, 0, 0, 1, 1, 2, 0, 0],
                [1, 0, 0, 1, 1, 1, 1, 0],
                [1, 0, 0, 1, 1, 1, 0, 1],
                [1, 0, 0, 1, 1, 0, 2, 0],
                [1, 0, 0, 1, 1, 0, 1, 1],
                [1, 0, 0, 1, 1, 0, 0, 2],
                [1, 0, 0, 1, 0, 3, 0, 0],
                [1, 0, 0, 1, 0, 2, 1, 0],
                [1, 0, 0, 1, 0, 2, 0, 1],
                [1, 0, 0, 1, 0, 1, 2, 0],
                [1, 0, 0, 1, 0, 1, 1, 1],
                [1, 0, 0, 1, 0, 0, 3, 0],
                [1, 0, 0, 1, 0, 0, 2, 1],
                [1, 0, 0, 1, 0, 0, 0, 3],
                [1, 0, 0, 0, 4, 0, 0, 0],
                [1, 0, 0, 0, 3, 1, 0, 0],
                [1, 0, 0, 0, 3, 0, 1, 0],
                [1, 0, 0, 0, 3, 0, 0, 1],
                [1, 0, 0, 0, 2, 2, 0, 0],
                [1, 0, 0, 0, 2, 1, 1, 0],
                [1, 0, 0, 0, 2, 1, 0, 1],
                [1, 0, 0, 0, 2, 0, 2, 0],
                [1, 0, 0, 0, 2, 0, 1, 1],
                [1, 0, 0, 0, 2, 0, 0, 2],
                [1, 0, 0, 0, 1, 3, 0, 0],
                [1, 0, 0, 0, 1, 2, 1, 0],
                [1, 0, 0, 0, 1, 2, 0, 1],
                [1, 0, 0, 0, 1, 1, 2, 0],
                [1, 0, 0, 0, 1, 1, 1, 1],
                [1, 0, 0, 0, 1, 1, 0, 2],
                [1, 0, 0, 0, 1, 0, 3, 0],
                [1, 0, 0, 0, 1, 0, 2, 1],
                [1, 0, 0, 0, 1, 0, 1, 2],
                [1, 0, 0, 0, 1, 0, 0, 3],
                [0, 5, 0, 0, 0, 0, 0, 0],
                [0, 4, 1, 0, 0, 0, 0, 0],
                [0, 4, 0, 1, 0, 0, 0, 0],
                [0, 4, 0, 0, 1, 0, 0, 0],
                [0, 4, 0, 0, 0, 1, 0, 0],
                [0, 4, 0, 0, 0, 0, 1, 0],
                [0, 4, 0, 0, 0, 0, 0, 1],
                [0, 3, 2, 0, 0, 0, 0, 0],
                [0, 3, 1, 1, 0, 0, 0, 0],
                [0, 3, 1, 0, 1, 0, 0, 0],
                [0, 3, 1, 0, 0, 1, 0, 0],
                [0, 3, 1, 0, 0, 0, 1, 0],
                [0, 3, 1, 0, 0, 0, 0, 1],
                [0, 3, 0, 2, 0, 0, 0, 0],
                [0, 3, 0, 1, 1, 0, 0, 0],
                [0, 3, 0, 1, 0, 1, 0, 0],
                [0, 3, 0, 1, 0, 0, 1, 0],
                [0, 3, 0, 1, 0, 0, 0, 1],
                [0, 3, 0, 0, 2, 0, 0, 0],
                [0, 3, 0, 0, 1, 1, 0, 0],
                [0, 3, 0, 0, 1, 0, 1, 0],
                [0, 3, 0, 0, 1, 0, 0, 1],
                [0, 3, 0, 0, 0, 2, 0, 0],
                [0, 3, 0, 0, 0, 1, 1, 0],
                [0, 3, 0, 0, 0, 1, 0, 1],
                [0, 3, 0, 0, 0, 0, 1, 1],
                [0, 3, 0, 0, 0, 0, 0, 2],
                [0, 2, 3, 0, 0, 0, 0, 0],
                [0, 2, 2, 1, 0, 0, 0, 0],
                [0, 2, 2, 0, 1, 0, 0, 0],
                [0, 2, 2, 0, 0, 1, 0, 0],
                [0, 2, 2, 0, 0, 0, 1, 0],
                [0, 2, 2, 0, 0, 0, 0, 1],
                [0, 2, 1, 2, 0, 0, 0, 0],
                [0, 2, 1, 1, 1, 0, 0, 0],
                [0, 2, 1, 1, 0, 1, 0, 0],
                [0, 2, 1, 1, 0, 0, 1, 0],
                [0, 2, 1, 1, 0, 0, 0, 1],
                [0, 2, 1, 0, 2, 0, 0, 0],
                [0, 2, 1, 0, 1, 1, 0, 0],
                [0, 2, 1, 0, 1, 0, 1, 0],
                [0, 2, 1, 0, 1, 0, 0, 1],
                [0, 2, 1, 0, 0, 2, 0, 0],
                [0, 2, 1, 0, 0, 1, 1, 0],
                [0, 2, 1, 0, 0, 1, 0, 1],
                [0, 2, 1, 0, 0, 0, 2, 0],
                [0, 2, 1, 0, 0, 0, 1, 1],
                [0, 2, 1, 0, 0, 0, 0, 2],
                [0, 2, 0, 3, 0, 0, 0, 0],
                [0, 2, 0, 2, 1, 0, 0, 0],
                [0, 2, 0, 2, 0, 1, 0, 0],
                [0, 2, 0, 2, 0, 0, 1, 0],
                [0, 2, 0, 2, 0, 0, 0, 1],
                [0, 2, 0, 1, 2, 0, 0, 0],
                [0, 2, 0, 1, 1, 1, 0, 0],
                [0, 2, 0, 1, 1, 0, 1, 0],
                [0, 2, 0, 1, 1, 0, 0, 1],
                [0, 2, 0, 1, 0, 2, 0, 0],
                [0, 2, 0, 1, 0, 1, 1, 0],
                [0, 2, 0, 1, 0, 1, 0, 1],
                [0, 2, 0, 1, 0, 0, 1, 1],
                [0, 2, 0, 1, 0, 0, 0, 2],
                [0, 2, 0, 0, 3, 0, 0, 0],
                [0, 2, 0, 0, 2, 1, 0, 0],
                [0, 2, 0, 0, 2, 0, 1, 0],
                [0, 2, 0, 0, 2, 0, 0, 1],
                [0, 2, 0, 0, 1, 2, 0, 0],
                [0, 2, 0, 0, 1, 1, 1, 0],
                [0, 2, 0, 0, 1, 1, 0, 1],
                [0, 2, 0, 0, 1, 0, 2, 0],
                [0, 2, 0, 0, 1, 0, 1, 1],
                [0, 2, 0, 0, 1, 0, 0, 2],
                [0, 2, 0, 0, 0, 3, 0, 0],
                [0, 2, 0, 0, 0, 2, 1, 0],
                [0, 2, 0, 0, 0, 2, 0, 1],
                [0, 2, 0, 0, 0, 1, 2, 0],
                [0, 2, 0, 0, 0, 1, 1, 1],
                [0, 2, 0, 0, 0, 1, 0, 2],
                [0, 2, 0, 0, 0, 0, 3, 0],
                [0, 2, 0, 0, 0, 0, 2, 1],
                [0, 2, 0, 0, 0, 0, 1, 2],
                [0, 2, 0, 0, 0, 0, 0, 3],
                [0, 1, 4, 0, 0, 0, 0, 0],
                [0, 1, 3, 1, 0, 0, 0, 0],
                [0, 1, 3, 0, 1, 0, 0, 0],
                [0, 1, 3, 0, 0, 1, 0, 0],
                [0, 1, 3, 0, 0, 0, 1, 0],
                [0, 1, 3, 0, 0, 0, 0, 1],
                [0, 1, 2, 2, 0, 0, 0, 0],
                [0, 1, 2, 1, 1, 0, 0, 0],
                [0, 1, 2, 1, 0, 1, 0, 0],
                [0, 1, 2, 1, 0, 0, 1, 0],
                [0, 1, 2, 1, 0, 0, 0, 1],
                [0, 1, 2, 0, 2, 0, 0, 0],
                [0, 1, 2, 0, 1, 1, 0, 0],
                [0, 1, 2, 0, 1, 0, 1, 0],
                [0, 1, 2, 0, 1, 0, 0, 1],
                [0, 1, 2, 0, 0, 2, 0, 0],
                [0, 1, 2, 0, 0, 1, 1, 0],
                [0, 1, 2, 0, 0, 1, 0, 1],
                [0, 1, 2, 0, 0, 0, 1, 1],
                [0, 1, 2, 0, 0, 0, 0, 2],
                [0, 1, 1, 3, 0, 0, 0, 0],
                [0, 1, 1, 2, 1, 0, 0, 0],
                [0, 1, 1, 2, 0, 1, 0, 0],
                [0, 1, 1, 2, 0, 0, 1, 0],
                [0, 1, 1, 2, 0, 0, 0, 1],
                [0, 1, 1, 1, 2, 0, 0, 0],
                [0, 1, 1, 1, 1, 1, 0, 0],
                [0, 1, 1, 1, 1, 0, 1, 0],
                [0, 1, 1, 1, 1, 0, 0, 1],
                [0, 1, 1, 1, 0, 2, 0, 0],
                [0, 1, 1, 1, 0, 1, 1, 0],
                [0, 1, 1, 1, 0, 1, 0, 1],
                [0, 1, 1, 1, 0, 0, 2, 0],
                [0, 1, 1, 1, 0, 0, 1, 1],
                [0, 1, 1, 1, 0, 0, 0, 2],
                [0, 1, 1, 0, 3, 0, 0, 0],
                [0, 1, 1, 0, 2, 1, 0, 0],
                [0, 1, 1, 0, 2, 0, 1, 0],
                [0, 1, 1, 0, 2, 0, 0, 1],
                [0, 1, 1, 0, 1, 2, 0, 0],
                [0, 1, 1, 0, 1, 1, 1, 0],
                [0, 1, 1, 0, 1, 1, 0, 1],
                [0, 1, 1, 0, 1, 0, 2, 0],
                [0, 1, 1, 0, 1, 0, 1, 1],
                [0, 1, 1, 0, 1, 0, 0, 2],
                [0, 1, 1, 0, 0, 3, 0, 0],
                [0, 1, 1, 0, 0, 2, 1, 0],
                [0, 1, 1, 0, 0, 2, 0, 1],
                [0, 1, 1, 0, 0, 1, 2, 0],
                [0, 1, 1, 0, 0, 1, 1, 1],
                [0, 1, 1, 0, 0, 1, 0, 2],
                [0, 1, 1, 0, 0, 0, 3, 0],
                [0, 1, 1, 0, 0, 0, 2, 1],
                [0, 1, 1, 0, 0, 0, 1, 2],
                [0, 1, 1, 0, 0, 0, 0, 3],
                [0, 1, 0, 4, 0, 0, 0, 0],
                [0, 1, 0, 3, 1, 0, 0, 0],
                [0, 1, 0, 3, 0, 1, 0, 0],
                [0, 1, 0, 3, 0, 0, 1, 0],
                [0, 1, 0, 3, 0, 0, 0, 1],
                [0, 1, 0, 2, 2, 0, 0, 0],
                [0, 1, 0, 2, 1, 1, 0, 0],
                [0, 1, 0, 2, 1, 0, 1, 0],
                [0, 1, 0, 2, 1, 0, 0, 1],
                [0, 1, 0, 2, 0, 2, 0, 0],
                [0, 1, 0, 2, 0, 1, 1, 0],
                [0, 1, 0, 2, 0, 1, 0, 1],
                [0, 1, 0, 2, 0, 0, 2, 0],
                [0, 1, 0, 2, 0, 0, 1, 1],
                [0, 1, 0, 2, 0, 0, 0, 2],
                [0, 1, 0, 1, 3, 0, 0, 0],
                [0, 1, 0, 1, 2, 1, 0, 0],
                [0, 1, 0, 1, 2, 0, 1, 0],
                [0, 1, 0, 1, 2, 0, 0, 1],
                [0, 1, 0, 1, 1, 2, 0, 0],
                [0, 1, 0, 1, 1, 1, 1, 0],
                [0, 1, 0, 1, 1, 1, 0, 1],
                [0, 1, 0, 1, 1, 0, 2, 0],
                [0, 1, 0, 1, 1, 0, 1, 1],
                [0, 1, 0, 1, 1, 0, 0, 2],
                [0, 1, 0, 1, 0, 3, 0, 0],
                [0, 1, 0, 1, 0, 2, 1, 0],
                [0, 1, 0, 1, 0, 2, 0, 1],
                [0, 1, 0, 1, 0, 1, 2, 0],
                [0, 1, 0, 1, 0, 1, 1, 1],
                [0, 1, 0, 1, 0, 1, 0, 2],
                [0, 1, 0, 1, 0, 0, 3, 0],
                [0, 1, 0, 1, 0, 0, 2, 1],
                [0, 1, 0, 1, 0, 0, 1, 2],
                [0, 1, 0, 1, 0, 0, 0, 3],
                [0, 1, 0, 0, 4, 0, 0, 0],
                [0, 1, 0, 0, 3, 1, 0, 0],
                [0, 1, 0, 0, 3, 0, 1, 0],
                [0, 1, 0, 0, 3, 0, 0, 1],
                [0, 1, 0, 0, 2, 2, 0, 0],
                [0, 1, 0, 0, 2, 1, 1, 0],
                [0, 1, 0, 0, 2, 1, 0, 1],
                [0, 1, 0, 0, 2, 0, 2, 0],
                [0, 1, 0, 0, 2, 0, 1, 1],
                [0, 1, 0, 0, 2, 0, 0, 2],
                [0, 1, 0, 0, 1, 3, 0, 0],
                [0, 1, 0, 0, 1, 2, 1, 0],
                [0, 1, 0, 0, 1, 2, 0, 1],
                [0, 1, 0, 0, 1, 1, 2, 0],
                [0, 1, 0, 0, 1, 1, 1, 1],
                [0, 1, 0, 0, 1, 1, 0, 2],
                [0, 1, 0, 0, 1, 0, 3, 0],
                [0, 1, 0, 0, 1, 0, 2, 1],
                [0, 1, 0, 0, 1, 0, 1, 2],
                [0, 1, 0, 0, 1, 0, 0, 3],
                [0, 1, 0, 0, 0, 4, 0, 0],
                [0, 1, 0, 0, 0, 3, 1, 0],
                [0, 1, 0, 0, 0, 3, 0, 1],
                [0, 1, 0, 0, 0, 2, 2, 0],
                [0, 1, 0, 0, 0, 2, 1, 1],
                [0, 1, 0, 0, 0, 1, 3, 0],
                [0, 1, 0, 0, 0, 1, 2, 1],
                [0, 1, 0, 0, 0, 1, 1, 2],
                [0, 1, 0, 0, 0, 1, 0, 3],
                [0, 1, 0, 0, 0, 0, 4, 0],
                [0, 1, 0, 0, 0, 0, 3, 1],
                [0, 1, 0, 0, 0, 0, 2, 2],
                [0, 1, 0, 0, 0, 0, 1, 3],
                [0, 1, 0, 0, 0, 0, 0, 4],
                [0, 0, 5, 0, 0, 0, 0, 0],
                [0, 0, 4, 1, 0, 0, 0, 0],
                [0, 0, 4, 0, 1, 0, 0, 0],
                [0, 0, 4, 0, 0, 1, 0, 0],
                [0, 0, 4, 0, 0, 0, 1, 0],
                [0, 0, 4, 0, 0, 0, 0, 1],
                [0, 0, 3, 2, 0, 0, 0, 0],
                [0, 0, 3, 1, 1, 0, 0, 0],
                [0, 0, 3, 1, 0, 1, 0, 0],
                [0, 0, 3, 1, 0, 0, 1, 0],
                [0, 0, 3, 1, 0, 0, 0, 1],
                [0, 0, 3, 0, 2, 0, 0, 0],
                [0, 0, 3, 0, 1, 1, 0, 0],
                [0, 0, 3, 0, 1, 0, 1, 0],
                [0, 0, 3, 0, 1, 0, 0, 1],
                [0, 0, 3, 0, 0, 2, 0, 0],
                [0, 0, 3, 0, 0, 1, 1, 0],
                [0, 0, 3, 0, 0, 1, 0, 1],
                [0, 0, 3, 0, 0, 0, 2, 0],
                [0, 0, 3, 0, 0, 0, 1, 1],
                [0, 0, 3, 0, 0, 0, 0, 2],
                [0, 0, 2, 3, 0, 0, 0, 0],
                [0, 0, 2, 2, 1, 0, 0, 0],
                [0, 0, 2, 2, 0, 1, 0, 0],
                [0, 0, 2, 2, 0, 0, 1, 0],
                [0, 0, 2, 2, 0, 0, 0, 1],
                [0, 0, 2, 1, 2, 0, 0, 0],
                [0, 0, 2, 1, 1, 1, 0, 0],
                [0, 0, 2, 1, 1, 0, 1, 0],
                [0, 0, 2, 1, 1, 0, 0, 1],
                [0, 0, 2, 1, 0, 2, 0, 0],
                [0, 0, 2, 1, 0, 1, 1, 0],
                [0, 0, 2, 1, 0, 1, 0, 1],
                [0, 0, 2, 1, 0, 0, 2, 0],
                [0, 0, 2, 1, 0, 0, 1, 1],
                [0, 0, 2, 1, 0, 0, 0, 2],
                [0, 0, 2, 0, 3, 0, 0, 0],
                [0, 0, 2, 0, 2, 1, 0, 0],
                [0, 0, 2, 0, 2, 0, 1, 0],
                [0, 0, 2, 0, 2, 0, 0, 1],
                [0, 0, 2, 0, 1, 2, 0, 0],
                [0, 0, 2, 0, 1, 1, 1, 0],
                [0, 0, 2, 0, 1, 1, 0, 1],
                [0, 0, 2, 0, 1, 0, 2, 0],
                [0, 0, 2, 0, 1, 0, 1, 1],
                [0, 0, 2, 0, 1, 0, 0, 2],
                [0, 0, 2, 0, 0, 3, 0, 0],
                [0, 0, 2, 0, 0, 2, 1, 0],
                [0, 0, 2, 0, 0, 2, 0, 1],
                [0, 0, 2, 0, 0, 1, 2, 0],
                [0, 0, 2, 0, 0, 1, 1, 1],
                [0, 0, 2, 0, 0, 1, 0, 2],
                [0, 0, 2, 0, 0, 0, 3, 0],
                [0, 0, 2, 0, 0, 0, 2, 1],
                [0, 0, 2, 0, 0, 0, 1, 2],
                [0, 0, 2, 0, 0, 0, 0, 3],
                [0, 0, 1, 4, 0, 0, 0, 0],
                [0, 0, 1, 3, 1, 0, 0, 0],
                [0, 0, 1, 3, 0, 1, 0, 0],
                [0, 0, 1, 3, 0, 0, 1, 0],
                [0, 0, 1, 3, 0, 0, 0, 1],
                [0, 0, 1, 2, 2, 0, 0, 0],
                [0, 0, 1, 2, 1, 1, 0, 0],
                [0, 0, 1, 2, 1, 0, 1, 0],
                [0, 0, 1, 2, 1, 0, 0, 1],
                [0, 0, 1, 2, 0, 2, 0, 0],
                [0, 0, 1, 2, 0, 1, 1, 0],
                [0, 0, 1, 2, 0, 1, 0, 1],
                [0, 0, 1, 2, 0, 0, 2, 0],
                [0, 0, 1, 2, 0, 0, 1, 1],
                [0, 0, 1, 2, 0, 0, 0, 2],
                [0, 0, 1, 1, 3, 0, 0, 0],
                [0, 0, 1, 1, 2, 1, 0, 0],
                [0, 0, 1, 1, 2, 0, 1, 0],
                [0, 0, 1, 1, 2, 0, 0, 1],
                [0, 0, 1, 1, 1, 2, 0, 0],
                [0, 0, 1, 1, 1, 1, 1, 0],
                [0, 0, 1, 1, 1, 1, 0, 1],
                [0, 0, 1, 1, 1, 0, 2, 0],
                [0, 0, 1, 1, 1, 0, 1, 1],
                [0, 0, 1, 1, 1, 0, 0, 2],
                [0, 0, 1, 1, 0, 3, 0, 0],
                [0, 0, 1, 1, 0, 2, 1, 0],
                [0, 0, 1, 1, 0, 2, 0, 1],
                [0, 0, 1, 1, 0, 1, 2, 0],
                [0, 0, 1, 1, 0, 1, 1, 1],
                [0, 0, 1, 1, 0, 1, 0, 2],
                [0, 0, 1, 1, 0, 0, 3, 0],
                [0, 0, 1, 1, 0, 0, 2, 1],
                [0, 0, 1, 1, 0, 0, 1, 2],
                [0, 0, 1, 1, 0, 0, 0, 3],
                [0, 0, 1, 0, 4, 0, 0, 0],
                [0, 0, 1, 0, 3, 1, 0, 0],
                [0, 0, 1, 0, 3, 0, 1, 0],
                [0, 0, 1, 0, 3, 0, 0, 1],
                [0, 0, 1, 0, 2, 2, 0, 0],
                [0, 0, 1, 0, 2, 1, 1, 0],
                [0, 0, 1, 0, 2, 1, 0, 1],
                [0, 0, 1, 0, 2, 0, 2, 0],
                [0, 0, 1, 0, 2, 0, 1, 1],
                [0, 0, 1, 0, 2, 0, 0, 2],
                [0, 0, 1, 0, 1, 3, 0, 0],
                [0, 0, 1, 0, 1, 2, 1, 0],
                [0, 0, 1, 0, 1, 2, 0, 1],
                [0, 0, 1, 0, 1, 1, 2, 0],
                [0, 0, 1, 0, 1, 1, 1, 1],
                [0, 0, 1, 0, 1, 1, 0, 2],
                [0, 0, 1, 0, 0, 4, 0, 0],
                [0, 0, 1, 0, 0, 3, 1, 0],
                [0, 0, 1, 0, 0, 3, 0, 1],
                [0, 0, 1, 0, 0, 2, 2, 0],
                [0, 0, 1, 0, 0, 2, 1, 1],
                [0, 0, 1, 0, 0, 2, 0, 2],
                [0, 0, 1, 0, 0, 1, 3, 0],
                [0, 0, 1, 0, 0, 1, 2, 1],
                [0, 0, 1, 0, 0, 1, 1, 2],
                [0, 0, 1, 0, 0, 1, 0, 3],
                [0, 0, 1, 0, 0, 0, 4, 0],
                [0, 0, 1, 0, 0, 0, 3, 1],
                [0, 0, 1, 0, 0, 0, 2, 2],
                [0, 0, 1, 0, 0, 0, 1, 3],
                [0, 0, 1, 0, 0, 0, 0, 4],
                [0, 0, 0, 5, 0, 0, 0, 0],
                [0, 0, 0, 4, 1, 0, 0, 0],
                [0, 0, 0, 4, 0, 1, 0, 0],
                [0, 0, 0, 4, 0, 0, 1, 0],
                [0, 0, 0, 4, 0, 0, 0, 1],
                [0, 0, 0, 3, 2, 0, 0, 0],
                [0, 0, 0, 3, 1, 1, 0, 0],
                [0, 0, 0, 3, 1, 0, 1, 0],
                [0, 0, 0, 3, 1, 0, 0, 1],
                [0, 0, 0, 3, 0, 2, 0, 0],
                [0, 0, 0, 3, 0, 1, 1, 0],
                [0, 0, 0, 3, 0, 1, 0, 1],
                [0, 0, 0, 3, 0, 0, 2, 0],
                [0, 0, 0, 3, 0, 0, 1, 1],
                [0, 0, 0, 3, 0, 0, 0, 2],
                [0, 0, 0, 2, 3, 0, 0, 0],
                [0, 0, 0, 2, 2, 1, 0, 0],
                [0, 0, 0, 2, 2, 0, 1, 0],
                [0, 0, 0, 2, 2, 0, 0, 1],
                [0, 0, 0, 2, 1, 2, 0, 0],
                [0, 0, 0, 2, 1, 1, 1, 0],
                [0, 0, 0, 2, 1, 1, 0, 1],
                [0, 0, 0, 2, 1, 0, 2, 0],
                [0, 0, 0, 2, 1, 0, 1, 1],
                [0, 0, 0, 2, 1, 0, 0, 2],
                [0, 0, 0, 2, 0, 3, 0, 0],
                [0, 0, 0, 2, 0, 2, 1, 0],
                [0, 0, 0, 2, 0, 2, 0, 1],
                [0, 0, 0, 2, 0, 1, 2, 0],
                [0, 0, 0, 2, 0, 1, 1, 1],
                [0, 0, 0, 2, 0, 1, 0, 2],
                [0, 0, 0, 2, 0, 0, 3, 0],
                [0, 0, 0, 2, 0, 0, 2, 1],
                [0, 0, 0, 2, 0, 0, 1, 2],
                [0, 0, 0, 2, 0, 0, 0, 3],
                [0, 0, 0, 1, 4, 0, 0, 0],
                [0, 0, 0, 1, 3, 1, 0, 0],
                [0, 0, 0, 1, 3, 0, 1, 0],
                [0, 0, 0, 1, 3, 0, 0, 1],
                [0, 0, 0, 1, 2, 2, 0, 0],
                [0, 0, 0, 1, 2, 1, 1, 0],
                [0, 0, 0, 1, 2, 1, 0, 1],
                [0, 0, 0, 1, 2, 0, 2, 0],
                [0, 0, 0, 1, 2, 0, 1, 1],
                [0, 0, 0, 1, 2, 0, 0, 2],
                [0, 0, 0, 1, 1, 3, 0, 0],
                [0, 0, 0, 1, 1, 2, 1, 0],
                [0, 0, 0, 1, 1, 2, 0, 1],
                [0, 0, 0, 1, 1, 1, 2, 0],
                [0, 0, 0, 1, 1, 1, 1, 1],
                [0, 0, 0, 1, 1, 1, 0, 2],
                [0, 0, 0, 1, 0, 4, 0, 0],
                [0, 0, 0, 1, 0, 3, 1, 0],
                [0, 0, 0, 1, 0, 3, 0, 1],
                [0, 0, 0, 1, 0, 2, 2, 0],
                [0, 0, 0, 1, 0, 2, 1, 1],
                [0, 0, 0, 1, 0, 2, 0, 2],
                [0, 0, 0, 1, 0, 1, 3, 0],
                [0, 0, 0, 1, 0, 1, 2, 1],
                [0, 0, 0, 1, 0, 1, 1, 2],
                [0, 0, 0, 1, 0, 0, 4, 0],
                [0, 0, 0, 1, 0, 0, 3, 1],
                [0, 0, 0, 1, 0, 0, 2, 2],
                [0, 0, 0, 1, 0, 0, 1, 3],
                [0, 0, 0, 1, 0, 0, 0, 4],
                [0, 0, 0, 0, 5, 0, 0, 0],
                [0, 0, 0, 0, 4, 1, 0, 0],
                [0, 0, 0, 0, 4, 0, 1, 0],
                [0, 0, 0, 0, 4, 0, 0, 1],
                [0, 0, 0, 0, 3, 2, 0, 0],
                [0, 0, 0, 0, 3, 1, 1, 0],
                [0, 0, 0, 0, 3, 1, 0, 1],
                [0, 0, 0, 0, 3, 0, 2, 0],
                [0, 0, 0, 0, 3, 0, 1, 1],
                [0, 0, 0, 0, 3, 0, 0, 2],
                [0, 0, 0, 0, 2, 3, 0, 0],
                [0, 0, 0, 0, 2, 2, 1, 0],
                [0, 0, 0, 0, 2, 2, 0, 1],
                [0, 0, 0, 0, 2, 1, 2, 0],
                [0, 0, 0, 0, 2, 1, 1, 1],
                [0, 0, 0, 0, 2, 0, 3, 0],
                [0, 0, 0, 0, 2, 0, 2, 1],
                [0, 0, 0, 0, 2, 0, 1, 2],
                [0, 0, 0, 0, 2, 0, 0, 3],
                [0, 0, 0, 0, 1, 4, 0, 0],
                [0, 0, 0, 0, 1, 3, 1, 0],
                [0, 0, 0, 0, 1, 3, 0, 1],
                [0, 0, 0, 0, 1, 2, 2, 0],
                [0, 0, 0, 0, 1, 2, 1, 1],
                [0, 0, 0, 0, 1, 2, 0, 2],
                [0, 0, 0, 0, 1, 1, 3, 0],
                [0, 0, 0, 0, 1, 1, 2, 1],
                [0, 0, 0, 0, 1, 1, 1, 2],
                [0, 0, 0, 0, 1, 1, 0, 3],
                [0, 0, 0, 0, 1, 0, 4, 0],
                [0, 0, 0, 0, 1, 0, 3, 1],
                [0, 0, 0, 0, 1, 0, 2, 2],
                [0, 0, 0, 0, 1, 0, 1, 3],
                [0, 0, 0, 0, 1, 0, 0, 4],
                [0, 0, 0, 0, 0, 5, 0, 0],
                [0, 0, 0, 0, 0, 4, 1, 0],
                [0, 0, 0, 0, 0, 4, 0, 1],
                [0, 0, 0, 0, 0, 3, 2, 0],
                [0, 0, 0, 0, 0, 3, 1, 1],
                [0, 0, 0, 0, 0, 3, 0, 2],
                [0, 0, 0, 0, 0, 2, 3, 0],
                [0, 0, 0, 0, 0, 2, 2, 1],
                [0, 0, 0, 0, 0, 2, 1, 2],
                [0, 0, 0, 0, 0, 2, 0, 3],
                [0, 0, 0, 0, 0, 1, 4, 0],
                [0, 0, 0, 0, 0, 1, 3, 1],
                [0, 0, 0, 0, 0, 1, 2, 2],
                [0, 0, 0, 0, 0, 1, 1, 3],
                [0, 0, 0, 0, 0, 1, 0, 4],
                [0, 0, 0, 0, 0, 0, 5, 0],
                [0, 0, 0, 0, 0, 0, 4, 1],
                [0, 0, 0, 0, 0, 0, 3, 2],
                [0, 0, 0, 0, 0, 0, 2, 3],
                [0, 0, 0, 0, 0, 0, 1, 4],
                [0, 0, 0, 0, 0, 0, 0, 5],
            ];
        }
        return $combies[\Turn::WEEKDAY];
    }
}