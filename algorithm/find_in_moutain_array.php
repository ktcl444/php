<?php

require_once 'base\AlgorithmBase.php';

//山脉数组中查找目标值-二分找山顶
class Solution extends \algorithm\base\AlgorithmBase
{
	private $mapping = [];
	function findInMountainArray($target, $mountainArr) {
		$this->mapping = [];
        $length = $mountainArr->length();
        $top = $this->getTop($mountainArr,0,$length-1);
		$ans = $this->findTarget($mountainArr,0,$top,$target);
		return $ans == - 1 ? $this->findTarget($mountainArr,$top + 1,$length - 1,$target,-1): $ans;
    }
	
	function getIndex($mount,$index){
		$ans = array_key_exists($index,$this->mapping) ? $this->mapping[$index] : $mount->get($index);
		$this->mapping[$index] = $ans;
		return $ans;
	}

	function findTarget($mount,$l,$r,$target,$toward = 1){
		$target = $toward * $target;
		while($l <= $r){
			$mid = ($l + $r) >> 1;
			$cur = $toward * $this->getIndex($mount,$mid);
			if($cur == $target){
				return $mid;
			}else if($cur < $target){
				$l = $mid + 1;
			}else{
				$r = $mid - 1;
			}
		}
		
		return -1;
	}

    function getTop($mount,$l,$r){
		while($l < $r){
			$mid = ($l + $r) >> 1;
			if($this->getIndex($mount,$mid) < $this->getIndex($mount,$mid+1)){
				$l = $mid + 1;
			}else{
				$r = $mid;
			}
		}
       return $l;
    }
	
	
	function test(){
		$m1 = new Mountain([3,5,3,2,0]);
		echo ($this->findInMountainArray(2,$m1)).PHP_EOL;
		$m2 = new Mountain([0,1,2,4,2,1]);
		echo ($this->findInMountainArray(3,$m2)).PHP_EOL;
		$m3 = new Mountain([1,5,2]);
		echo ($this->findInMountainArray(2,$m3)).PHP_EOL;
	}
}

class Mountain{
	private $array = [];
	function __construct($array){
		$this->array = $array;
	}
	
	function length(){
		return count($this->array);
	}
	
	function get($index){
		return $this->array[$index];
	}
}

(new Solution())->test();