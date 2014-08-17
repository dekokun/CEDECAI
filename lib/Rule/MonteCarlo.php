<?php

namespace Rule;

class MonteCarlo extends Rule
{
    protected function doEvaluate(\Heroines $heroines, \Turn $turn)
    {
        return 1;
    }

    public function result(\Heroines $heroines, \Turn $turn)
    {
        $allRemainPoints = $this->allRemainPoints($heroines, $turn);
        foreach($this->myPointChoiceCombination($turn) as $choice) {

        }
    }

    public function myPointChoiceCombination(\Turn $turn) {
        if ($turn->nextTurnIsHoliday()) {
            return [[0, 0, 0, 0, 0, 0, 2, 2], [0, 0, 0, 0, 2, 0, 0, 2]];
        }
        return [[0, 0, 0, 0, 2, 0, 2, 1], [0, 0, 0, 1, 1, 0, 2, 1]];
    }

    public function allRemainPoints(\Heroines $heroines, \Turn $turn) {
        $afterMyActionTurn = new \Turn($turn->getNextTurn() + 1);
        $me = $this->getRemainPoints($heroines, $afterMyActionTurn);
        $p1 = $this->getRemainPoints($heroines, $turn);
        $p2 = $this->getRemainPoints($heroines, $turn);
        $p3 = $this->getRemainPoints($heroines, $turn);
        return [$me, $p1, $p2, $p3];
    }

    public function getRemainPoints(\Heroines $heroines, \Turn $turn) {
        $remainActionCounts = $this->getRemainActionCounts($turn->getRemainTurns());
        $weekDayPoints = $this->getWhichHeroine(
            $remainActionCounts[\Turn::WEEKDAY], $heroines
        );
        $holidayPoints = array_map(
            function($value){
                return $value * 2;
            },
            $this->getWhichHeroine(
                $remainActionCounts[\Turn::HOLIDAY], $heroines
            )
        );
        $allPoints = array_map(
            function($a, $b){return $a + $b;},
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
