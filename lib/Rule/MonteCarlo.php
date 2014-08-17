<?php

namespace Rule;

class MonteCarlo extends Rule
{
    const TRIAL_COUNT = 2;

    protected function doEvaluate(\Heroines $heroines, \Turn $turn)
    {
        return 1;
    }

    public function result(\Heroines $heroines, \Turn $turn)
    {
        $myPointChoiceCombination = $this->myPointChoiceCombination($turn);
        $topCounts = array_fill(0, count($myPointChoiceCombination), 0);
        for ($i = 0; $i < static::TRIAL_COUNT; $i++) {
            $allRemainPoints = $this->allRemainPoints($heroines, $turn);
            foreach ($myPointChoiceCombination as $i => $choice) {
                // 自分の点数を置き換え
                $points = $allRemainPoints;
                $myPoints = array_map(
                    function ($a, $b) {
                        return $a + $b;
                    },
                    $points[0],
                    $choice
                );
                $points[0] = $myPoints;
                if ($this->isTop($points)) {
                    $topCounts[$i] = $topCounts;
                }
            }
        }
        $maxTopCount = max($topCounts);
        $maxTopStrategy = array_search($maxTopCount, $topCounts);
        logging($myPointChoiceCombination[$maxTopStrategy]);
        return new \Heroines($myPointChoiceCombination[$maxTopStrategy]);
    }

    public function isTop(array $points) {
        return true;
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
                $combies[\Turn::HOLIDAY]
                    = [[0, 0, 0, 0, 0, 0, 2, 2], [0, 0, 0, 0, 2, 0, 0, 2]];
            }
            return $combies[\Turn::HOLIDAY];
        }
        if (! isset($combies[\Turn::WEEKDAY])) {
            $combies[\Turn::WEEKDAY]
                = [[0, 0, 0, 0, 2, 0, 2, 1], [0, 0, 0, 1, 1, 0, 2, 1]];
        }
        return $combies[\Turn::WEEKDAY];
    }

    public function allRemainPoints(\Heroines $heroines, \Turn $turn)
    {
        $afterMyActionTurn = new \Turn($turn->getNextTurn() + 1);
        $me = $this->getRemainPoints($heroines, $afterMyActionTurn);
        $p1 = $this->getRemainPoints($heroines, $turn);
        $p2 = $this->getRemainPoints($heroines, $turn);
        $p3 = $this->getRemainPoints($heroines, $turn);
        return [$me, $p1, $p2, $p3];
    }

    public function getRemainPoints(\Heroines $heroines, \Turn $turn)
    {
        $remainActionCounts = $this->getRemainActionCounts($turn->getRemainTurns());
        $weekDayPoints = $this->getWhichHeroine(
            $remainActionCounts[\Turn::WEEKDAY], $heroines
        );
        $holidayPoints = array_map(
            function ($value) {
                return $value * 2;
            },
            $this->getWhichHeroine(
                $remainActionCounts[\Turn::HOLIDAY], $heroines
            )
        );
        $allPoints = array_map(
            function ($a, $b) {
                return $a + $b;
            },
            $weekDayPoints,
            $holidayPoints
        );
        return $allPoints;
    }

    private function getRemainActionCounts(array $remainTurns)
    {
        $remainHolidayActionCount = $remainTurns[\Turn::HOLIDAY] * 2;
        $remainWeekdayActionCount = $remainTurns[\Turn::WEEKDAY] * 5;
        return [
            \Turn::HOLIDAY => $remainHolidayActionCount,
            \Turn::WEEKDAY => $remainWeekdayActionCount
        ];
    }

    /**
     * @param $count
     * @param \Heroines $heroines
     * @return array
     */
    public function getWhichHeroine($count, \Heroines $heroines)
    {
        $result = array_fill(0, 8, 0);
        $heroineCount = count($heroines);
        // array_randがキーを順番通りに出力する性質を使用
        $divisionPoses = array_rand(
            array_fill(0, $heroineCount + $count - 1, 0),
            $heroineCount - 1
        );
        $beforeDivisionPos = -1;
        foreach ($divisionPoses as $i => $divisionPos) {
            $result[$i] = ($divisionPos - $beforeDivisionPos) - 1;
            $beforeDivisionPos = $divisionPos;
        }
        $result[$heroineCount - 1]
            = $heroineCount + $count - 1 - $beforeDivisionPos - 1;
        return $result;
    }
}
