<?php

require_once 'base\AlgorithmBase.php';

//搜索旋转排序数组
class Solution extends \algorithm\base\AlgorithmBase
{
    function search($nums, $target) {
        $length = count($nums);
		$left = 0;
		$right = $length - 1;
		while($left <= $right)
		{
			$cen = floor(($left + $right) /2);
			echo 'l='.$left.' r='.$right .' cen = '.$cen.PHP_EOL;
			if($nums[$cen] == $target)
				return $cen;
			if($nums[$cen] < $nums[$right])
			{
				if($nums[$cen] < $target && $target <= $nums[$right])
				{
					$left =$cen +1 ;
				}else
				{
					$right = $cen - 1;
				}
			}else
			{
				if($nums[$left] <= $target && $target < $nums[$cen])
				{
					$right = $cen - 1;
				}else
				{
					$left = $cen +1;
					}
			}
		}
		return -1;
    }
	
	function test(){
		
		//echo $this->search([4,5,6,7,0,1,2],0).PHP_EOL;
		//echo $this->search([4,5,6,7,0,1,2],3).PHP_EOL;
			//echo $this->search([1,3],1).PHP_EOL;
			echo $this->search([3,5,1],3).PHP_EOL;
	}
}

(new Solution())->test();