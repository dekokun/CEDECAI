<?php


class Heroines implements ArrayAccess, Iterator, Countable {
    private $heroines = [];

    public function __construct(array $heroines) {
        $this->heroines = $heroines;
    }

    /**
     * @return \Heroines
     */
    public function getMaxEnthusiasmHeroines() {
        return new static(
            array_filter($this->toArray(), function(\Heroine $heroine) {
            return $heroine->getEnthusiasm() === $this->getMaxEnthusiasm();
        }));
    }

    /**
     * @return \Heroines
     */
    public function getSecondEnthusiasmHeroines() {
        $enthusisms = $this->getEnthusiasms();
        $uniqueArray = array_unique($enthusisms);
        rsort($uniqueArray);
        $secondEnthusiasm = $uniqueArray[1];
        return new static(
            array_filter($this->toArray(), function(\Heroine $heroine) use ($secondEnthusiasm) {
                return $heroine->getEnthusiasm() === $secondEnthusiasm;
            }));
    }
    public function alldateCount() {
        $result = 0;
        foreach($this->heroines as $heroine) {
            $result += $heroine->getDateCount();
        }
        return $result;
    }

    /**
     * @return \Heroines
     */
    public function getMinEnthusiasmHeroines() {
        return new static(
            array_filter($this->toArray(), function(\Heroine $heroine) {
            return $heroine->getEnthusiasm() === $this->getMinEnthusiasm();
        }));
    }
    /**
     * @param int $order
     * @return \Heroines
     * @throws \Exception
     */
    public function getSortByEnthusiasmHeroines($order = SORT_DESC) {
        $heroines = $this->heroines;
        usort($heroines, function(\Heroine $heroine1, \Heroine $heroines2) {
            if ($heroine1->getEnthusiasm() === $heroines2->getEnthusiasm()) {
                return 0;
            }
            return
                ($heroine1->getEnthusiasm() > $heroines2->getEnthusiasm())
                    ? -1 : 1;
        });
        if ($order === SORT_DESC) {
            return new static($heroines);
        }
        if ($order === SORT_ASC) {
            return new static(array_reverse($heroines));
        }
        throw new \Exception('SORT_ASCかSORT_DESC使ってね');
    }

    /**
     * @param $index
     * @return \Heroine
     */
    public function getHeroine($index) {
        return $this->heroines[$index];
    }
    /**
     * @return int
     */
    public function getMaxEnthusiasm() {
        return max($this->getEnthusiasms());
    }

    /**
     * @return int
     */
    public function getMinEnthusiasm() {
        return min($this->getEnthusiasms());
    }
    /**
     * @param int $count
     * @return \Heroines
     */
    public function getRandomHeroines($count) {
        $heroines = $this->toArray();
        shuffle($heroines);
        return new \Heroines(array_slice($heroines, 0, $count));
    }

    /**
     * @return \Heroine
     */
    public function getRandomHeroine() {
        $heroines = $this->toArray();
        shuffle($heroines);
        return end($heroines);
    }
    /**
     * @return array
     */
    public function getEnthusiasms() {
        static $cache;
        if (! $cache) {
            $cache = array_map(function(\Heroine $heroine) {
                    return $heroine->getEnthusiasm();
                }, $this->toArray());
        }
        return $cache;
    }


    /**
     * @return \Heroine[]
     */
    public function toArray() {
        return $this->heroines;
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

