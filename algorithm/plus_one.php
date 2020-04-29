<?php

require_once 'base\AlgorithmBase.php';

//加一-从后往前
class Solution extends \algorithm\base\AlgorithmBase
{
    function plusOne($digits) {
		
		$length = count($digits);
		for($i = $length - 1;$i >= 0;$i--	){
			$digits[$i]++;
			$digits[$i] = $digits[$i] % 10;
			if($digits[$i] != 0)return $digits; 
		}
		
		array_unshift($digits,1);
		return $digits;
    }
	
	function test(){
		print_r($this->plusOne([1,2,3]));
		print_r($this->plusOne([4,3,2,1]));
		print_r($this->plusOne([9,9,9]));
	}
}

(new Solution())->test();