<?php

require_once 'base\AlgorithmBase.php';

//有序矩阵中第K小的元素-二分
class Solution extends \algorithm\base\AlgorithmBase
{
	function kthSmallest($matrix,$k){
		$rows = count($matrix);
		$cols = count($matrix[0]);
		$left = $matrix[0][0];
		$right = $matrix[$rows-1][$cols-1];
		while($left < $right){
			$mid = intval(($left + $right)/2);
			$count = $this->findK($matrix,$mid,$rows,$cols);
			if($count < $k){
				$left = $mid + 1;
			}else
			{
				$right = $mid;
			}
		}
		
		return $right;
	}
	
	function findK($matrix,$mid,$rows,$cols){
		$i = $rows - 1;
		$j = 0;
		$count = 0;
		while($j < $cols && $i >= 0){
			if($matrix[$i][$j] <= $mid){
				$count += $i+1;
				$j++;
			}else{
				$i--;
			}
		}
		return $count;
	}
	
	function test(){
		echo $this->kthSmallest([
			[1,4,7,11,15],
			[2,5,8,12,19],
			[3,6,9,16,22],
			[10,13,14,17,24],
			[18,21,23,26,30]
		],5).PHP_EOL;
		
		
		
		echo $this->kthSmallest([
		   [ 1,  5,  9],
		   [10, 11, 13],
		   [12, 13, 15]
		],8).PHP_EOL;
	}
}

(new Solution())->test();