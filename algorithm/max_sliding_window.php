<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
	#region 堆栈(存储最大值索引)
	function maxSlidingWindow($nums, $k) {
		$length = count($nums);
		if($length * $k ==0) return [];
		
		$stack = [];
		$result = [];
		
		for($i=0;$i<$length;$i++)
		{
			while($stack && ($nums[end($stack)] < $nums[$i]))
			{
				array_pop($stack);
			}
			$stack[] = $i;
			if($stack[0] == $i -$k)
			{
				array_shift($stack);
			}
			if($i >= $k -1)
			{
				print_r($stack);
				$result[] = $nums[$stack[0]];
			}
		}
		return $result;
	}
		
	#endregion
	
	#region 动态规划(左右数组)
	function maxSlidingWindow2($nums, $k) {
		$length = count($nums);
		if($length * $k ==0) return [];
		if($k == 1) return $nums;
		
		$left = [];
		$right = [];
		
		$left[0] = $nums[0];
		$right[$length - 1] = $nums[$length-1];
		
		for($i =1;$i < $length;$i++)
		{
			if($i % $k == 0)$left[$i] = $nums[$i];
			else $left[$i] = max($nums[$i],$left[$i-1]);
			
			$j = $length - $i - 1;
			if(($j + 1) % $k == 0)$right[$j] = $nums[$j];
			else $right[$j] = max($nums[$j],$right[$j+1]);
		}
		
		$result = [];
		for($i =0;$i < $length - $k + 1;$i++)
		{
			$result[$i] = max($right[$i],$left[$i+$k-1]);
		}
		
		return $result;
	}
	#endregion
	
	function  test()
	{
		print_r($this->maxSlidingWindow([1,3,-1,-3,5,3,6,7],3));
	}
}

(new Solution())->test();