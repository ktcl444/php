<?php

require_once 'base\AlgorithmBase.php';

//最大数-字符串排序
class Solution extends \algorithm\base\AlgorithmBase
{	
	function largestNumber($nums){
		uasort($nums,function($a,$b){
			return strcmp($b.$a,$a.$b); 
		});
		if(current($nums) == 0)return '0';
		$result = '';
		foreach($nums as $num){
			$result .= $num;
		}
		
		return $result;
	}

	function test(){
		echo($this->largestNumber([10,2])).PHP_EOL;
		echo($this->largestNumber([3,30,34,5,9])).PHP_EOL;
		echo($this->largestNumber([0,9,8,7,6,5,4,3,2,1])).PHP_EOL;
	}
}

(new Solution())->test();