<?php

require_once 'base\AlgorithmBase.php';

// 最大矩形-动态规划
class Solution extends \algorithm\base\AlgorithmBase
{
    function maximalRectangle($matrix) {
		if(empty($matrix)) return 0;
		$row = count($matrix);
		$col = count($matrix[0]);
		
		$height = array_fill(0,$col,0);
		$left = array_fill(0,$col,0);
		$right = array_fill(0,$col,$col);
		$max = 0;
		for($i = 0;$i < $row;$i++)
		{
			$cur_left = 0;
			$cur_right = $col;
			for($j = 0;$j < $col;$j++)
			{
				if($matrix[$i][$j] == '1')
					$height[$j]++;
				else
					$height[$j] = 0;
			}
			for($j=0;$j<$col;$j++)
			{
				if($matrix[$i][$j] == '1')
					$left[$j] = max($left[$j],$cur_left);
				else
				{
					$left[$j] = 0;
					$cur_left = $j + 1;
				}
			}
			for($j = $col - 1;$j>=0;$j--)
			{
				if($matrix[$i][$j] == '1')
					$right[$j] = min($right[$j],$cur_right);
				else
				{
					$right[$j] = $col;
					$cur_right = $j;
				}
			}
			for($j = 0;$j < $col;$j++)
			{
				$max = max($max,($right[$j] - $left[$j])*$height[$j]);
			}
		}
        return $max;
    }
	function test(){
		echo  $this->maximalRectangle(
			[
			  ["1","0","1","0","0"],
			  ["1","0","1","1","1"],
			  ["1","1","1","1","1"],
			  ["1","0","0","1","0"]
			]
		).PHP_EOL;
	}
}

(new Solution())->test();