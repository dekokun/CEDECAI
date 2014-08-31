<?php

class Turn {
    const WEEKDAY = 'W';
    const HOLIDAY = 'H';
    const ALL_TURN = 10;

    protected $nextTurn;
    protected $nextDayKind;

    public function __construct($turn, $dayKind = null) {
        $this->nextTurn = intval($turn);
        if ($dayKind === null) {
            $dayKind = ($turn % 2 === 0) ? static::HOLIDAY : static::WEEKDAY;
        }
        $this->nextDayKind = $dayKind;
    }

    public function dayIter() {
        for ($i = 0; $i < $this->nextDayCount(); $i++) {
            yield $i;
        }
    }

    /**
     * @return int
     */
    public function getNextTurn() {
        return $this->nextTurn;
    }

    /**
     * @return int
     */
    public function holidayCountToNow() {
        if ($this->nextTurnIsHoliday()) {
            return ($this->nextTurn - 2) / 2;
        }
        return ($this->nextTurn - 1) / 2;
    }

    /**
     * @return int[]
     */
    public function getRemainTurns() {
        $remainTurn = (static::ALL_TURN - $this->getNextTurn()) + 1;
        if ($remainTurn % 2 === 0) {
            return [
                static::HOLIDAY => $remainTurn / 2,
                static::WEEKDAY => $remainTurn / 2
            ];
        }
        return [
            static::HOLIDAY => ($remainTurn + 1) / 2,
            static::WEEKDAY => (($remainTurn + 1) / 2) - 1
        ];
    }
    /**
     * @return bool
     */
    public function nextTurnIsHoliday() {
        return ($this->nextDayKind === static::HOLIDAY);
    }

    /**
     * @return bool
     */
    public function nextTurnIsWeekDay() {
        return (! $this->nextTurnIsHoliday());
    }

    /**
     * @return bool
     */
    public function previousTurnIsHoliday() {
        return (! $this->nextTurnIsHoliday());
    }

    /**
     * @return bool
     */
    public function previousTurnIsWeekDay() {
        return (! $this->nextTurnIsHoliday());
    }

    public function nextDayCount() {
        if ($this->nextTurnIsWeekDay()) {
            return 5;
        }
        return 2;
    }
}
