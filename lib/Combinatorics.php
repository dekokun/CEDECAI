<?php

class Combinatorics
{
    static function combinationSimple(array $origin, $r)
    {
        $n = count($origin);
        if ($n < $r) {
            return array();
        }
        if (!$r) {
            return array(array());
        }
        if ($n == $r) {
            return array(range(0, $n-1));
        }

        $return = array();
        $n2 = $n - 1;
        //(n-1)Crはほしい組み合わせの一部
        foreach (static::combination($n2, $r) as $row) {
            $return[] = $row;
        }
        //(n-1)C(r-1)にn-1を追加する。
        foreach (static::combination($n2, $r-1) as $row) {
            $row[] = $n2;
            $return[] = $row;
        }
        return $return;
    }
}
