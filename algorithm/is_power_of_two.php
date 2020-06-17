<?php

require_once 'base\AlgorithmBase.php';

//2的幂
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 除法
    function isPowerOfTwo($n) {
		if($n == 0)return false;
		while($n % 2 == 0){
			$n = $n / 2;
		}
		
		return $n == 1;
    }
	#endregion
	
	#region 位运算
	function isPowerOfTwo($n) {
		if($n == 0)return false;
		return ($x & ($x - 1)) == 0;
    }
	#endregion
	
	function test(){
		
	}
}
(new Solution())->test();