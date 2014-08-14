<?php

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
     * @var \Rule\RuleSelector
     */
    protected $ruleSelector;

    public function __construct() {
        $this->io = new StdIO(fopen('php://stdin', 'r'));
        $this->setting = new GameSettings();
        $this->ruleSelector = new \Rule\RuleSelector([
            new \Rule\RandomHoliday(),
            new \Rule\RandomWeekday(),
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
