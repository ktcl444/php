<?php

require_once 'base\AlgorithmBase.php';

//缺失数字-求和公式
class Solution extends \algorithm\base\AlgorithmBase
{
	function missingNumber($nums){
		$length = count($nums);
		$sum = 0;
		for($i = 0;$i < $length;$i++){
			$sum +=  $nums[$i];
		}
		$expected =  ((1 + $length) * $length) / 2;
		return $expected - $sum;
	}
	
	function test(){
		echo $this->missingNumber([0,2,3]).PHP_EOL;
	}
}

(new Solution())->test();