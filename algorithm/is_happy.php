<?php

require 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
	#region 快慢指针
	function isHappy($n){
		$slow = $n;
		$fast = $this->getNext($n);
		while($fast != 1 && $slow != $fast){
			$slow =$this->getNext($slow);
			$fast = $this->getNext($this->getNext($fast));
		}
		return $fast == 1;
	}
	#endregion
	
	#region 字典循环
	function isHappy2($n){
		$exist = [];
		while($n != 1 && !array_key_exists($n,$exist)){
			$exist[$n] = 1;
			$n = $this->getNext($n);
		}
		
		return $n == 1;
	}
	
	function getNext($n){
		$sum = 0;
		$length = strlen($n);
		for($i = 0;$i< $length;$i++){
			$sum += pow(intval(substr($n,$i,1)),2);
		}
/* 		while($n > 0){
			$d = $n % 10;
			$n = $n / 10;
			$sum += $d * $d;
		} */
		return $sum;
	}
	#endregion
	
	function test(){
		echo ($this->isHappy(19)? '1':'0').PHP_EOL;
		echo ($this->isHappy(28)? '1':'0').PHP_EOL;
	}
}

(new Solution())->test();