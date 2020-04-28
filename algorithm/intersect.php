<?php

require_once 'base\AlgorithmBase.php';

//两个数组的交集-字典+排序
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 字典
	function intersect1($nums1,$nums2){
		$map1 = [];
		$length1 = count($nums1);
		$length2 = count($nums2);
		if($length1== 0 || $length2 == 0)return [];
		if($length1 > $length2)return $this->intersect($nums2,$nums1);
		
		for($i = 0;$i<$length1;$i++){
			$map1[$nums1[$i]]++;
		}		
		$result = [];
		foreach($nums2 as $num){
			if(array_key_exists($num,$map1) && $map1[$num] > 0){
				$map1[$num]--;
				$result[] = $num;
			}
		}
		
		return $result;
	}
	#endregion
	
	#region 排序
	function intersect($nums1,$nums2){
		sort($nums1);
		sort($nums2);
		
		$i = 0;
		$j = 0;
		$k = 0;
		while($i < count($nums1) && $j < count($nums2)){
			if($nums1[$i] < $nums2[$j]){
				$i++;
			}else if($nums1[$i] > $nums2[$j]){
				$j++;
			}else{
				$nums1[$k++] = $nums1[$i++];
				$j++;
			}
		}
		
		return array_slice($nums1,0,$k);
	}
	#endregion
	
	function test(){
		
		print_r($this->intersect([1,2,2,1],[2,2]));
	}
}

(new Solution())->test();