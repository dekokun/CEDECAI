<?php

class StdIO {
    protected $fp;

    public function __construct($fp) {
        $this->fp = $fp;
    }

    public function getIn() {
        return fgets($this->fp);
    }
    public function outPut($data) {
        echo $data;
    }
    public function outPutArray(array $array) {
        $this->outPut(implode(' ', $array) . PHP_EOL);
    }
}

function logging($message) {
    $message = $message . PHP_EOL;
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
    protected $maxTurn;
    protected $numOfPlayers;
    protected $numOfHeroines;
    protected $turn;
    protected $day;
    protected $heroines = [];

    public function __construct() {
        logging('hogehoge');
        $this->io = new StdIO(fopen('php://stdin', 'r'));
    }

    public function main() {
        $this->io->outPut('READY');
        $this->readGameSetting();

        for ($i = 0; $i < $this->maxTurn; $i++) {
            $this->readData();
            $this->writeCommand();
        }

    }

    function readGameSetting() {
        $gameSettings = explode(' ', rtrim($this->io->getIn()));
        $this->maxTurn = $gameSettings[0];
        $this->numOfPlayers = $gameSettings[1];
        $this->numOfHeroines = $gameSettings[2];

        $gameSettings = explode(' ', rtrim($this->io->getIn()));
        foreach ($gameSettings as $enthusiasm) {
            array_push($this->heroines, new Heroine((integer)$enthusiasm));
        }
    }

    function readData() {
        list($turn, $this->day) = explode(' ', rtrim($this->io->getIn()));
        for ($i = 0; $i < $this->numOfHeroines; $i++) {
            $revealedScores = explode(' ', rtrim($this->io->getIn()));
        }
        $realScores = explode(' ', rtrim($this->io->getIn()));
        for ($i = 0; $i < $this->numOfHeroines; $i++) {
            $this->heroines[$i]->setRealScore((integer)$realScores[$i]);
        }
        if ($this->day === 'W') {
            $dated = explode(' ', rtrim($this->io->getIn()));
            for ($i = 0; $i < $this->numOfHeroines; $i++) {
                $this->heroines[$i]->setDated((integer)$dated[$i]);
            }
        }
    }

    function writeCommand() {
        $heroineNums = [];
        if ($this->day === 'W') {
            for ($i = 0; $i < 5; $i++) {
                $heroineNums[] = mt_rand(0, $this->numOfHeroines - 3);
            }
        } else {
            $heroineNums[] = mt_rand(0, $this->numOfHeroines - 1) . ' ' . mt_rand(0, $this->numOfHeroines - 3);
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
