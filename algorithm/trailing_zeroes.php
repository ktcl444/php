<?php

require_once 'base\AlgorithmBase.php';

//阶乘后的零-统计5出现的次数
class Solution extends \algorithm\base\AlgorithmBase
{
    function trailingZeroes($n) {
		$count = 0;
		while($n > 0){
			$n /= 5 ;
			$count += $n;
		}
		
		return $count;
    }
	
	function test(){
		echo $this->trailingZeroes(10);
	}
}

(new Solution())->test();