<?php

require_once 'base\AlgorithmBase.php';
//两整数之和
class Solution extends \algorithm\base\AlgorithmBase
{
	function getSum($a,$b){
		while($b != 0){
			$temp = $a ^ $b;
			$carry = ($a & $b) << 1;
			
			$a = $temp;
			$b = $carry;
		}
		
		return $a;
	}
	
	function test(){
		echo $this->getSum(1,2).PHP_EOL;
	}
}

(new Solution())->test();