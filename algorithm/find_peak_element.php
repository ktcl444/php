<?php

require_once 'base\AlgorithmBase.php';

//寻找峰值-二分
class Solution extends \algorithm\base\AlgorithmBase
{
    function findPeakElement2($nums) {
		$length = count($nums);
		array_unshift($nums,PHP_INT_MIN);
		array_push($nums,PHP_INT_MIN);
		$left = 0;
		$right = $length + 1;
		while($left < $right - 1){
			$center = intval(($left + $right) /2);
			if($nums[$center] > $nums[$center -1] && $nums[$center]> $nums[$center+1]){
				return $center - 1;
			}		
			else if($nums[$center] < $nums[$center - 1]){
				$right = $center;
			}else if($nums[$center] < $nums[$center +1]){
				$left = $center;
			}
		}
		
		return -1;
	}
	
	function findPeakElement($nums) {
		$left = 0;
		$right = count($nums) - 1;
		while($left < $right){
			$center = intval(($left + $right) / 2);
			if($nums[$center] >$nums[$center + 1]){
				$right = $center;
			}else{
				$left = $center + 1;
			}
		}
		return $left;
	}

	function test(){
		echo($this->findPeakElement([])).PHP_EOL;
		echo($this->findPeakElement([1])).PHP_EOL;
		echo($this->findPeakElement([1,2,3,1])).PHP_EOL;
		echo($this->findPeakElement([1,3,2,1])).PHP_EOL;
		echo($this->findPeakElement([1,2,3,4,5])).PHP_EOL;
	}
}

(new Solution())->test();