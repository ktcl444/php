<?php

require_once 'base\AlgorithmBase.php';
class RecentCounter {
    private $stack;
    /**
     */
    function __construct() {
        $this->stack = [];
    }
  
    /**
     * @param Integer $t
     * @return Integer
     */
    function ping($t) {
        while(!empty($this->stack) && $t - current($this->stack) > 3000){
            array_shift($this->stack);
			if($t == 3002)
				print_r($this->stack);
        }
        $this->stack[] = $t;
        return count($this->stack);
    }
}
$c = new RecentCounter();
echo $c->ping(1).PHP_EOL;
echo $c->ping(100).PHP_EOL;
echo $c->ping(3001).PHP_EOL;
echo $c->ping(3002).PHP_EOL;