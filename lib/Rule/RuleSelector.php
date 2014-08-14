<?php

namespace Rule;

class RuleSelector {
    protected $rules = [];

    public function __construct(array $rules) {
        $this->rules = $rules;
    }

    /**
     * @param \Heroines $heroines
     * @param \Turn $turn
     * @return Rule
     */
    public function choice(\Heroines $heroines, \Turn $turn) {
        $evaluatedValues = array_map(function(Rule $rule) use($heroines, $turn) {
            return $rule->evaluate($heroines, $turn);
        }, $this->rules);
        $selectedRule = $this->rules[array_search(
            max($evaluatedValues), $evaluatedValues
        )];
        logging('selected rule: ' . get_class($selectedRule));
        return $selectedRule;
    }
}
