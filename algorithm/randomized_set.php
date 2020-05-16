<?php
//常数时间插入、删除和获取随机元素-哈希表+动态列表
class RandomizedSet 
{
	private $stack = [];
	private $index = 0;
	private $data  = [];
    /**
     * Initialize your data structure here.
     */
    function __construct() {
    }
  
    /**
     * Inserts a value to the set. Returns true if the set did not already contain the specified element.
     * @param Integer $val
     * @return Boolean
     */
    function insert($val) {
        if(!array_key_exists($val,$this->stack)){
			$this->stack[$val] = $this->index;
			$this->data[$this->index++] = $val;
			return true;
		}
		
		return false;
    }
  
    /**
     * Removes a value from the set. Returns true if the set contained the specified element.
     * @param Integer $val
     * @return Boolean
     */
    function remove($val) {
		if(!array_key_exists($val,$this->stack)){
			return false;
		}
		
		$remove_index= $this->stack[$val];
		$last_data = $this->data[$this->index - 1];
		
		$this->stack[$last_data] = $remove_index;
		$this->data[$remove_index] = $last_data;
		
		unset($this->stack[$val]);
		unset($this->data[$this->index - 1]);
		return true;
    }
  
    /**
     * Get a random element from the set.
     * @return Integer
     */
    function getRandom() {
		return $this->index == 0 ? null : $this->data[rand(0,$this->index-1)];
    }
}

$obj =new RandomizedSet();
$ret_1 = $obj->insert(1);
echo $ret_1.PHP_EOL;
$ret_1 = $obj->insert(-2);
echo $ret_1.PHP_EOL;
$ret_1 = $obj->insert(5);
echo $ret_1.PHP_EOL;
$ret_2 = $obj->remove(2);
echo $ret_2.PHP_EOL;
$ret_3 = $obj->getRandom();
echo $ret_3.PHP_EOL; 