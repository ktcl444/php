<?php

require_once 'base\AlgorithmBase.php';

//实现strstr
class Solution extends \algorithm\base\AlgorithmBase
{
	function mySqrt($x){
		if($x < 2) return $x;
		$left = intval(($this->mySqrt(intval($x/4)))<<1);
		$right = $left +1 ;
		return $right * $right > $x ? $left : $right;
	}
	
	function test(){
		echo $this->mySqrt(9).PHP_EOL;
		echo $this->mySqrt(456).PHP_EOL;
	}
}

(new Solution())->test();