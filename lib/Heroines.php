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
     * @return int
     */
    public function getMaxEnthusiasm() {
        return max($this->getEnthusiasms());
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
    private function getEnthusiasms() {
        return array_map(function(\Heroine $heroine) {
            return $heroine->getEnthusiasm();
        }, $this->toArray());
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

