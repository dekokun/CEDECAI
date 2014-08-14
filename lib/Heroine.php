<?php

class Heroine {
    private $enthusiasm;
    private $revealedScores;
    private $realScore;
    private $dated;
    private $dateCount = 0;
    private $index;

    function __construct(
        $index,
        $enthusiasm = 0,
        array $revealedScores = [],
        $realScore = 0,
        $dated = 0
    ) {
        $this->index = $index;
        $this->enthusiasm = $enthusiasm;
        $this->revealedScores = $revealedScores;
        $this->realScore = $realScore;
        $this->dated = $dated;
    }

    public function getIndex() {
        return $this->index;
    }

    /**
     * @return int
     */
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
