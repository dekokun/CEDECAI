<?php

class StdIO {
    protected $fp;

    public function __construct($fp) {
        $this->fp = $fp;
    }

    public function getIn() {
        return fgets($this->fp);
    }
    public function getInArray() {
        return explode(' ', rtrim($this->getIn()));
    }
    public function outPut($data) {
        echo $data;
    }
    public function outPutArray(array $array) {
        $this->outPut(implode(' ', $array) . PHP_EOL);
    }
}

class Turn {
    const WEEKDAY = 'W';
    const HOLIDAY = 'H';

    protected $turn;
    protected $dayKind;

    public function __construct($turn, $dayKind) {
        $this->turn = $turn;
        $this->dayKind = $dayKind;
    }

    public function getTurn() {
        return $this->turn;
    }

    /**
     * @return bool
     */
    public function isHoliday() {
        return ($this->dayKind === static::HOLIDAY);
    }

    /**
     * @return bool
     */
    public function isWeekDay() {
        return (! $this->isHoliday());
    }

    /**
     * @return bool
     */
    public function previousTurnIsHoliday() {
        return (! $this->isHoliday());
    }

    /**
     * @return bool
     */
    public function previousTurnIsWeekDay() {
        return (! $this->isHoliday());
    }
}

class GameSettings {
    public $maxTurn;
    public $numOfPlayers;
    public $numOfHeroines;
    public $enthusiasms;

    public function setSettingOne(array $input) {
        $this->maxTurn = $input[0];
        $this->numOfPlayers = $input[1];
        $this->numOfHeroines = $input[2];
    }

    public function setSettingTwo(array $input) {
        $this->enthusiasms = $input;
    }
}

function logging($message) {
    $message = var_export($message, true) . PHP_EOL;
    fputs(STDERR,$message);
    error_log($message, 3, '/tmp/hoge.log');
}

logging('start');
$game = new Game();
logging('main');
$game->main();
logging('end');

class Game {

    /**
     * @var StdIO
     */
    protected $io;
    /**
     * @var GameSettings
     */
    protected $setting;
    /**
     * @var Turn
     */
    protected $turn;
    protected $heroines = [];

    public function __construct() {
        $this->io = new StdIO(fopen('php://stdin', 'r'));
        $this->setting = new GameSettings();
    }

    public function main() {
        $this->io->outPut('READY');
        $this->readGameSetting();

        for ($i = 0; $i < $this->setting->maxTurn; $i++) {
            $this->readData();
            $this->writeCommand();
        }

    }

    private function readGameSetting() {
        $this->setting->setSettingOne($this->io->getInArray());

        $this->setting->setSettingTwo($this->io->getInArray());
        foreach ($this->setting->enthusiasms as $enthusiasm) {
            array_push($this->heroines, new Heroine((integer)$enthusiasm));
        }
    }

    private function readData() {
        list($turn, $day) = $this->io->getInArray();
        $this->turn = new Turn($turn, $day);
        for ($i = 0; $i < $this->setting->numOfHeroines; $i++) {
            $revealedScores = $this->io->getInArray();
        }
        $realScores = $this->io->getInArray();
        for ($i = 0; $i < $this->setting->numOfHeroines; $i++) {
            $this->heroines[$i]->setRealScore((integer)$realScores[$i]);
        }
        if ($this->turn->previousTurnIsHoliday()) {
            $dated = $this->io->getInArray();
            for ($i = 0; $i < $this->setting->numOfHeroines; $i++) {
                $this->heroines[$i]->setDated((integer)$dated[$i]);
            }
        }
    }

    private function writeCommand() {
        $heroineNums = [];
        if ($this->turn->isWeekDay()) {
            for ($i = 0; $i < 5; $i++) {
                $heroineNums[] = mt_rand(0, $this->setting->numOfHeroines - 3);
            }
        } else {
            $heroineNums[] = mt_rand(0, $this->setting->numOfHeroines - 1) . ' ' . mt_rand(0, $this->setting->numOfHeroines - 3);
        }
        $this->io->outPutArray($heroineNums);
    }

}


class Heroine {
    private $enthusiasm;
    private $revealedScore;
    private $realScore;
    private $dated;

    function __construct($enthusiasm = 0, $revealedScore = 0, $realScore = 0, $dated = 0) {
        $this->enthusiasm = $enthusiasm;
        $this->revealedScore = $revealedScore;
        $this->realScore = $realScore;
        $this->dated = $dated;
    }

    public function getEnthusiasm() {
        return $this->enthusiasm;
    }

    public function setEnthusiasm($enthusiasm) {
        $this->enthusiasm = $enthusiasm;
    }

    public function getRevealedScore() {
        return $this->revealedScore;
    }

    public function setRevealedScore($revealedScore) {
        $this->revealedScore = $revealedScore;
    }

    public function getRealScore() {
        return $this->realScore;
    }

    public function setRealScore($realScore) {
        $this->realScore = $realScore;
    }

    public function getDated() {
        return $this->dated;
    }

    public function setDated($dated) {
        $this->dated = $dated;
    }
}
