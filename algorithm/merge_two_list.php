<?php

require_once 'base\AlgorithmBase.php';

//两个数组的交集-字典+排序
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 合并排序
    function merge2(&$nums1, $m, $nums2, $n) {
		$nums1 = array_slice($nums1,0,$m);
        $nums1 = array_merge($nums1,$nums2);
		sort($nums1);
    }
	#endregion
	
	#region 双指针(从前往后)
	function merge1(&$nums1, $m, $nums2, $n) {
		$p1= 0;
		$p2 = 0;
		$p = 0;
		$result = [];
		$temp = array_slice($nums1,0,$m);
		while($p1 < $m && $p2 < $n){
			if($temp[$p1] < $nums2[$p2])
				$nums1[$p++] = $temp[$p1++];
			else
				$nums1[$p++] = $nums2[$p2++];
		}
		if($p1 < $m){
			array_splice($nums1,$p1+$p2,count($nums1) - $p1-$p2,array_slice($temp,$p1));
		}
		if($p2 < $n){
			array_splice($nums1,$p1+$p2,count($nums1) - $p1-$p2,array_slice($nums2,$p2));
		}
		
	}
	#endregion
	
	#region 双指针(从后往前)
	function merge(&$nums1, $m, $nums2, $n) {
		$p1= $m - 1;
		$p2 = $n - 1;
		$p = $m + $n  - 1;
		while($p1 >=0 && $p2 >= 0){
			if($nums1[$p1] < $nums2[$p2])
				$nums1[$p--] = $nums2[$p2--];
			else
				$nums1[$p--] = $nums1[$p1--];
		}
		
		if($p2 >= 0){
			array_splice($nums1,0,$p2+1,array_slice($nums2,0,$p2+1));
		}
	}
	#endregion
	
	function test(){
		$nums1 = [1,2,3,0,0,0];
		$nums2 = [2,5,6];
		$this->merge($nums1,3,$nums2,3);
		print_r($nums1);
	}
}

(new Solution())->test();