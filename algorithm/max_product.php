<?php

require_once 'base\AlgorithmBase.php';

//[乘积最大子数组-动态规划]
class Solution extends \algorithm\base\AlgorithmBase
{
	function maxProduct($nums) {
		$length = count($nums);
		if($length == 0)return 0;
		$max = PHP_INT_MIN;
		$t_min = 1;
		$t_max = 1;
		for($i = 0; $i <$length;$i++)
		{
			if($nums[$i] < 0)
			{
				$temp = $t_min;
				$t_min = $t_max;
				$t_max = $temp;
			}
			$t_min = min($t_min * $nums[$i],$nums[$i]);
			$t_max = max($t_max * $nums[$i],$nums[$i]);
			$max = max($max,$t_max);
		}
		//print_r($dp);
		return $max;
    }
	function test(){
		//[2,-5,-2,-4,3]
		
		echo $this->maxProduct([2,-5,-2,-4,3]).PHP_EOL;
		echo $this->maxProduct([2,3,-2,-4]).PHP_EOL;
 		echo $this->maxProduct([2,3,-2,4]).PHP_EOL;
		echo $this->maxProduct([-2,0,-1]).PHP_EOL;
		echo $this->maxProduct([-2]).PHP_EOL;
		echo $this->maxProduct([-4,-3]).PHP_EOL;
		echo $this->maxProduct([0,2]).PHP_EOL; 
	}
}

(new Solution())->test();