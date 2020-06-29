<?php

require_once 'base\AlgorithmBase.php';
//数组排序-归并+快排
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 归并排序
	function sortArray($nums) {
		$this->megerSort($nums,0,count($nums)-1);
		return $nums;
	}
	
	function megerSort(&$nums,$l,$r){
		if($l >= $r)
			return;
		
		$mid = intval(($l + $r)/2);
		$this->megerSort($nums,$l,$mid);
		$this->megerSort($nums,$mid+1,$r);
		$i =  $l;
		$j = $mid +1;
		$tmp = [];
		while($i <= $mid && $j <= $r){
			if($nums[$i] < $nums[$j]){
				$tmp[] = $nums[$i++];
			}else{
				$tmp[] = $nums[$j++];
			}
		}
		
		while($i <= $mid){
			$tmp[] = $nums[$i++];
		}
		while($j <= $r){
			$tmp[] = $nums[$j++];
		}
		
		for($i = 0;$i < $r - $l + 1;$i++){
			$nums[$l + $i] = $tmp[$i];
		}
	}
	#endregion
	
	#region 快速排序
	function sortArray1($nums) {
        $this->quick_sort($nums,0,count($nums)-1);
		return $nums;
    }
	
	function quick_sort(&$nums,$l,$r){
		if($l < $r){
			$pos = $this->random_partition($nums,$l,$r);
			$this->quick_sort($nums,$l,$pos - 1);
			$this->quick_sort($nums,$pos + 1,$r);
		}
	}
	
	function random_partition(&$nums,$l,$r){
		$rand = rand($l,$r);
		$this->swap($nums,$rand,$r);
		return $this->partition($nums,$l,$r);
	}
	
	function partition(&$nums,$l,$r){
		$pivot = $nums[$r];
		$i = $l - 1;
		for($j = $l;$j < $r;$j++){
			if($nums[$j] <= $pivot){
				$i++;
				$this->swap($nums,$i,$j);
			}
		}
		$this->swap($nums,$i+1,$r);
		
		return $i + 1;
	}
	
	function swap(&$nums,$i,$j){
		$temp = $nums[$i];
		$nums[$i] = $nums[$j];
		$nums[$j] = $temp;
	}
	#endregion
	
	function test(){
		print_r($this->sortArray([3,1,2]));
		print_r($this->sortArray([3,1,2,7,0,6,4]));
	}
}

(new Solution())->test();