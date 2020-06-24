<?php

require '..\base\AlgorithmBase.php';

//三维形体的表面积-减去重叠
class Solution extends \algorithm\base\AlgorithmBase
{
	function surfaceArea($grid) {
        $area = 0;
		$rows = count($grid);
		$cols = count($grid[0]);
		
		for($i = 0;$i < $rows;$i++){
			for($j = 0;$j < $cols;$j++){
				$cur = $grid[$i][$j];
				$area += ($cur * 4 + 2);
				if($i > 0){
					$area -= (min($cur,$grid[$i-1][$j]) * 2);
				}
				if($j > 0){
					$area -= (min($cur,$grid[$i][$j-1])*2);
				}
			}
		}
		
		return $area;
    }
	
    function test()
    {
		echo ($this->surfaceArea([[2]])).PHP_EOL;
    }
}

(new Solution())->test();