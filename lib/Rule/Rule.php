<?php

namespace Rule;

abstract class Rule {
    /**
     * @param \Heroines $heroines
     * @param \Turn $turn
     * @return int
     */
    public function evaluate(\Heroines $heroines, \Turn $turn) {
        return $this->doEvaluate($heroines, $turn);
    }

    abstract protected function doEvaluate(\Heroines $heroines, \Turn $turn);

    /**
     * @param \Heroines $heroines
     * @param \Turn $turn
     * @return array
     */
    abstract public function result(\Heroines $heroines, \Turn $turn);
}
