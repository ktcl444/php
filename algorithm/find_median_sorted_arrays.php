<?php

require_once 'base\AlgorithmBase.php';

// 编辑距离
class Solution extends \algorithm\base\AlgorithmBase
{
    function findMedianSortedArrays($nums1, $nums2) {
		$merge = array_merge($nums1,$nums2);
		$length = count($merge);
		sort($merge);
		if($length % 2 == 0){
		
			$end = $length / 2;
			$first = $end- 1;
			$result = ($merge[$first]+$merge[$end]) /2 ;
		}else
		{
			$index = ($length -1)/2;
			$result = $merge[$index];
		}
		
		return $result;
    }
	function test(){
		//echo  $this->findMedianSortedArrays([1,3],[2]).PHP_EOL;
		echo  $this->findMedianSortedArrays([1,2],[3,4]).PHP_EOL;
	}
}

(new Solution())->test();