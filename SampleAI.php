<?php

class Heroines implements ArrayAccess, Iterator, Countable {
    private $heroines = [];

    public function __construct(array $heroines) {
        $this->heroines = $heroines;
    }

    public function rewind()  {
        reset($this->heroines);
    }
    public function current() {
        return current($this->heroines);
    }
    public function key() {
        return key($this->heroines);
    }
    public function next() {
        return next($this->heroines);
    }
    public function valid() {
        return ($this->current() !== false);
    }
    public function count() {
        return count($this->heroines);
    }

    /**
     * オフセットが存在するかどうか
     * @param mixed $offset 調べたいオフセット
     * @return bool 成功した場合に TRUE を、失敗した場合に FALSE を返します。
     */
    public function offsetExists ($offset) {
        return array_key_exists($offset, $this->heroines);
    }
    /**
     * オフセットを取得する
     * @param mixed $offset 調べたいオフセット
     * @return mixed 指定したオフセットの値
     */
    public function offsetGet ($offset) {
        return $this->heroines[$offset];
    }
    /**
     * オフセットを設定する
     * @param mixed $offset 調べたいオフセット
     * @param mixed $value 設定したい値
     */
    public function offsetSet ($offset ,$value ) {
        $this->heroines[$offset] = $value;
    }
    /**
     * オフセットの設定を解除する
     * @param mixed $offset 設定解除したいオフセット
     */
    public function offsetUnset ($offset ) {
        unset($this->heroines[$offset]);
    }
}



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

    protected $nextTurn;
    protected $nextDayKind;

    public function __construct($turn, $dayKind) {
        $this->nextTurn = $turn;
        $this->nextDayKind = $dayKind;
    }

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
    fputs(STDERR, $message);
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
    /**
     * @var Heroines
     */
    protected $heroines;
    /**
     * @var RuleSelector
     */
    protected $ruleSelector;

    public function __construct() {
        $this->io = new StdIO(fopen('php://stdin', 'r'));
        $this->setting = new GameSettings();
        $this->ruleSelector = new RuleSelector([
            new RandomHolidayRule(),
            new RandomWeekdayRule(),
        ]);
    }

    public function main() {
        $this->io->outPut('READY');
        $this->readGameSetting();

        for ($i = 0; $i < $this->setting->maxTurn; $i++) {
            $this->readData();
            $heroineNums
                = $this->ruleSelector
                ->choice($this->heroines, $this->turn)
                ->result($this->heroines, $this->turn);
            $this->io->outPutArray($heroineNums);
        }

    }

    private function readGameSetting() {
        $this->setting->setSettingOne($this->io->getInArray());

        $this->setting->setSettingTwo($this->io->getInArray());
        $heroines = [];
        foreach ($this->setting->enthusiasms as $enthusiasm) {
            array_push($heroines, new Heroine((integer)$enthusiasm));
        }
        $this->heroines = new Heroines($heroines);
    }

    private function readData() {
        list($turn, $day) = $this->io->getInArray();
        $this->turn = new Turn($turn, $day);
        foreach($this->heroines as $i => $_) {
            $revealedScores = $this->io->getInArray();
            $this->heroines[$i]->setRevealedScores($revealedScores);
        }
        $realScores = $this->io->getInArray();
        foreach($this->heroines as $i => $_) {
            $this->heroines[$i]->setRealScore((integer)$realScores[$i]);
        }
        if ($this->turn->previousTurnIsHoliday()) {
            $dated = $this->io->getInArray();
            foreach($this->heroines as $i => $_) {
                $this->heroines[$i]->setDated((integer)$dated[$i]);
            }
        }
    }
}


class Heroine {
    private $enthusiasm;
    private $revealedScores;
    private $realScore;
    private $dated;
    private $dateCount = 0;

    function __construct(
        $enthusiasm = 0,
        array $revealedScores = [],
        $realScore = 0,
        $dated = 0
    ) {
        $this->enthusiasm = $enthusiasm;
        $this->revealedScores = $revealedScores;
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
        return $this->revealedScores;
    }

    public function setRevealedScores($revealedScore) {
        $this->revealedScores = $revealedScore;
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

    public function getDateCount() {
        return $this->dateCount;
    }
    public function setDated($dated) {
        $this->dateCount += $dated;
        $this->dated = $dated;
    }
}

class RuleSelector {
    protected $rules = [];

    public function __construct(array $rules) {
        $this->rules = $rules;
    }

    /**
     * @param Heroines $heroines
     * @param Turn $turn
     * @return Rule
     */
    public function choice(Heroines $heroines, Turn $turn) {
        $evaluatedValues = array_map(function(Rule $rule) use($heroines, $turn) {
            return $rule->evaluate($heroines, $turn);
        }, $this->rules);
        return $this->rules[array_search(max($evaluatedValues), $evaluatedValues)];
    }
}

abstract class Rule {
    /**
     * @param Heroines $heroines
     * @param Turn $turn
     * @return int
     */
    abstract public function evaluate(Heroines $heroines, Turn $turn);

    /**
     * @param Heroines $heroines
     * @param Turn $turn
     * @return array
     */
    abstract public function result(Heroines $heroines, Turn $turn);
}

class RandomHolidayRule extends Rule {
    public function evaluate(Heroines $heroines, Turn $turn) {
        if ($turn->nextTurnIsWeekDay()) {
            return 0;
        }
        return 1;
    }
    public function result(Heroines $heroines, Turn $turn) {
        $heroineNums = [];
        for ($i = 0; $i < $turn->nextDayCount(); $i++) {
            $heroineNums[] = mt_rand(0, count($heroines) - 3);
        }
        return $heroineNums;
    }
}

class RandomWeekdayRule extends Rule {
    public function evaluate(Heroines $heroines, Turn $turn) {
        if ($turn->nextTurnIsHoliday()) {
            return 0;
        }
        return 1;
    }
    public function result(Heroines $heroines, Turn $turn) {
        $heroineNums = [];
        for ($i = 0; $i < $turn->nextDayCount(); $i++) {
            $heroineNums[] = mt_rand(0, count($heroines) - 3);
        }
        return $heroineNums;
    }
}
