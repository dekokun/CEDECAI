<?php


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
