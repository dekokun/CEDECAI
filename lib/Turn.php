<?php

class Turn {
    const WEEKDAY = 'W';
    const HOLIDAY = 'H';

    protected $nextTurn;
    protected $nextDayKind;

    public function __construct($turn, $dayKind) {
        $this->nextTurn = intval($turn);
        $this->nextDayKind = $dayKind;
    }

    /**
     * @return int
     */
    public function getNextTurn() {
        return $this->nextTurn;
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
