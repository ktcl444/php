<?php


class LRUCache {
	private $max = 0;
	public $stack = [];
    /**
     * @param Integer $capacity
     */
    function __construct($capacity) {
		$this->max = $capacity;
    }

    /**
     * @param Integer $key
     * @return Integer
     */
    function get($key) {
		if(! array_key_exists($key,$this->stack))
		return -1;
		$value =$this->stack[$key];
		$end_key = end(array_keys($this->stack));
		if($key != $end_key){
			unset($this->stack[$key]);
			$this->stack[$key] =$value;
		}
		
		return $value;
    }

    function put($key, $value) {
		if(! array_key_exists($key,$this->stack)){
			if(count($this->stack) == $this->max)
			{
				$keys = array_keys($this->stack);
				unset($this->stack[$keys[0]]);
			}
		}else{
			$end_key = end(array_keys($this->stack));
			if($key != $end_key){
				unset($this->stack[$key]);
			} 
		}
		$this->stack[$key] =$value;
    }
}

 $cache = new LRUCache(2);
/* $cache->put(1,1);
$cache->put(2,2);
echo $cache->get(1).PHP_EOL;
 $cache->put(3,3);
 echo $cache->get(2).PHP_EOL;
$cache->put(4,4);
echo $cache->get(1).PHP_EOL;
echo $cache->get(3).PHP_EOL;
echo $cache->get(4).PHP_EOL;   */
$cache->put(2,1);
$cache->put(1,1);
echo $cache->get(2).PHP_EOL;
print_r($cache->stack);
$cache->put(4,1);
print_r($cache->stack);
echo $cache->get(1).PHP_EOL;
echo $cache->get(2).PHP_EOL;

