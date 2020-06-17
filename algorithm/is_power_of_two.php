<?php

require_once 'base\AlgorithmBase.php';

//2的幂
class Solution extends \algorithm\base\AlgorithmBase
{
    function isPowerOfTwo($n) {
		if($n == 0)return false;
		while($n % 2 == 0){
			$n = $n / 2;
		}
		
		return $n == 1;
    }
	
	function isPowerOfTwo($n) {

    }
	
	function test(){
		
	}
}
(new Solution())->test();