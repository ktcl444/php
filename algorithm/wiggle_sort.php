<?php

require_once 'base\AlgorithmBase.php';

//摆动排序-快速选择(两数组依次插入)
class Solution extends \algorithm\base\AlgorithmBase
{	
    function wiggleSort(&$nums) {
		$length = count($nums);
		$center = $length /2;
		$this->quick_select($nums,0,$length,$center);
		$mid = $nums[$center];
		
		$i = 0;
		$j = 0;
		$k  = $length-1;
		while($j < $k){
			if($nums[$j] > $mid){
				$this->swap($nums,$j,$k--);
			}else if($nums[$j] < $mid){
				$this->swap($nums,$i++,$j++);
			}else{
				$j++;
			}
		}
		if($length % 2)$center++;
		$temp1 = $nums;
		$temp1 = array_slice($temp1,0,$center);
		$temp2 = $nums;
		$temp2 = array_splice($temp2,$center);

		for($i = 0;$i<count($temp1);$i++){
			$nums[2*$i] = $temp1[count($temp1) - 1 - $i];
		}
		for($i = 0;$i < count($temp2);$i++){
			$nums[2 * $i + 1] = $temp2[count($temp2) - 1 - $i];
		}
    }
	function quick_select(&$nums,$begin,$end,$n){
		$t = $nums[$end-1];
		$i = $begin;
		$j = $begin;
		while($j < $end){
			if($nums[$j] <= $t){
				$this->swap($nums,$i++,$j++);
			}else{
				$j++;
			}
		}
		if($n < $i - 1){
			$this->quick_select($nums,$begin,$i-1,$n);
		}else if($i <= $n){
			$this->quick_select($nums,$i,$end,$n);
		}
	}
	
	public function swap(array &$nums, $index1, $index2)
    {
        $tmp = $nums[$index1];
        $nums[$index1] = $nums[$index2];
        $nums[$index2] = $tmp;
    }
	
	function test(){
		$nums = [1, 5, 1, 1, 6, 4];
		$this->wiggleSort($nums);
		//print_r($nums);
	}
}

(new Solution())->test();