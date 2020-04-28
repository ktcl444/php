<?php

require_once 'base\AlgorithmBase.php';

//删除排序数组中的重复项-双指针
class Solution extends \algorithm\base\AlgorithmBase
{
	function removeDuplicates($nums){
		$length = count($nums);
		$index = 1;
		$pre = $nums[0];
		for($i = 1;$i < $length;$i++){
			if($nums[$i] != $pre){
				$pre = $nums[$i];
				$nums[$index++] = $nums[$i];
			}
		}
		
		return $index;
	}
	
	function test(){
		echo $this->removeDuplicates([1,1,2]).PHP_EOL;
		echo $this->removeDuplicates([0,0,1,1,1,2,2,3,3,4]).PHP_EOL;
	}
}

(new Solution())->test();