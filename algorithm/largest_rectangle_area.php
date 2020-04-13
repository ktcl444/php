<?php

require_once 'base\AlgorithmBase.php';

// 柱状图中的最大矩形-堆栈+暴力
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 堆栈
	 function largestRectangleArea($heights) {
		if(empty($heights)) return 0;
		
		$max = 0;
		$stack = [-1];
		$heights[] = -1;
		$col = count($heights);
		for($i=0;$i<$col;$i++)
		{
			while(end($stack) != -1 && $heights[end($stack)] >= $heights[$i])
			{
				$index = array_pop($stack);
				$max = max($max,$heights[$index] * ($i - end($stack) - 1));
			}
			$stack[] = $i;
		}
		return $max;
	 }
	 #endregion
	 
	 #region 暴力法
    function largestRectangleArea2($heights) {
		if(empty($heights)) return 0;
		$col = count($heights);
		
		$max = 0;
		
		for($i = 0;$i<$col;$i++)
		{
			$left_index = $i;
			while($left_index - 1 >= 0 && $heights[$left_index -1] >= $heights[$i])
			{
				$left_index--;
			}
			$right_index = $i;
			while($right_index +1 <= $col -1 && $heights[$right_index+1] >= $heights[$i])
			{
				$right_index++;
			}
			$max = max($max,$heights[$i] * ($right_index - $left_index + 1));
		}
        return $max;
    }
	#endregion
	function test(){
		echo  $this->largestRectangleArea([2,1,5,6,2,3]).PHP_EOL;
	}
}

(new Solution())->test();