<?php

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
