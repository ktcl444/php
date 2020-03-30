<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
    function searchRange($nums, $target) {
        $result =[-1,-1];
		$length = count($nums);
		if($length == 0 || $target < $nums[0] || $nums[$length - 1] < $target)
		{
			return $result;
		}
		
		$left = 0;
		$right = $length ;
		$center = 0;
		while($left < $right){
			$center = floor(($left + $right) / 2);
			if($nums[$center] == $target)
			{
				$start = $center;
				$end = $center;
				$pre = $center -1;
				while($pre >= 0 && $nums[$pre] == $target)
				{
					$start = $pre;
					$pre -- ;
				}
				$next = $center + 1;
				while($next < $length && $nums[$next] == $target)
				{
					$end = $next;
					$next ++;
				}
				return [$start,$end];
			}else if($nums[$center] < $target)
			{
				$left = $center + 1 ;
			}
			else{
				$right = $center;
			}
		}
		
		return $result;
    }
	
	function test(){
		print_r($this->searchRange([5,7,7,8,8,10],8));
		print_r($this->searchRange([5,7,7,8,8,10],6));
	}
}

(new Solution())->test();