<?php

require_once 'base\AlgorithmBase.php';

//旋转数组
class Solution extends \algorithm\base\AlgorithmBase
{
/* 	原始数组                  : 1 2 3 4 5 6 7
	反转所有数字后             : 7 6 5 4 3 2 1
	反转前 k 个数字后          : 5 6 7 4 3 2 1
	反转后 n-k 个数字后        : 5 6 7 1 2 3 4 --> 结果 */
	function rotate(&$nums,$k){
		$length = count($nums);
		$k = $k % $length;
		$this->reverse($nums,0,$length - 1);
		$this->reverse($nums,0,$k -1);
		$this->reverse($nums,$k,$length - 1);
	}
	function reverse(&$nums,$start,$end){
		while($start < $end){
			$temp = $nums[$start];
			$nums[$start] = $nums[$end];
			$nums[$end]= $temp;
			$start++;
			$end--;
		}		
	}
	//环形旋转
	 function rotate0(&$nums,$k){
		$length = count($nums);
		$k = $k % $length;
		$count = 0;
		for($start = 0;$count < $length;$start++){
			$cur = $start;
			$pre = $nums[$start];
			do{
				$next = ($cur + $k) % $length;
				$temp = $nums[$next];
				$nums[$next] = $pre;
				$cur = $next;
				$pre = $temp;
				$count++;
			}while($start != $cur);
		}
	 }
	//延长数组
	 function rotate1(&$nums, $k) {
		$length = count($nums);
		$k = $k % $length;
		$nums = array_merge($nums,$nums);
		for($i = $length - $k - 1;$i >= 0;$i--){
			$nums[$i + $k] = $nums[$i];
		}
		for($i = 0;$i < $k;$i++){
			$nums[$i] = $nums[$length * 2 - $k + $i];
		}
		$nums = array_slice($nums,0,$length);
	 }
	//复制后段?
    function rotate2(&$nums, $k) {
		$length = count($nums);
		$k = $k % $length;
		$copy_array = array_slice($nums,$length - $k,$k);
		for($i = $k;$i >= 0;$i--){
			$nums[$i + $k] = $nums[$i];
		}
		for($i = 0;$i < $k;$i++){
			$nums[$i] = $copy_array[$i];
		}
    }
	 //暴力
	 function rotate3(&$nums,$k){
		$length = count($nums);
		$k = $k % $length;
		for($i = 0;$i < $k;$i++){
			$pre = $nums[$length - 1];
			for($j = 0;$j < $length;$j++){
				$temp = $nums[$j];
				$nums[$j] = $pre;
				$pre = $temp;
			}
		}
	 }
	
	function test(){
		$nums= [1] ;
		$this->rotate($nums,0);
		print_r($nums);
 		$nums= [1,2,3,4,5,6,7] ;
		$this->rotate($nums,3);
		print_r($nums); 
	}
}

(new Solution())->test();