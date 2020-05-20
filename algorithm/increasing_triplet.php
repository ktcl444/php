<?php

require_once 'base\AlgorithmBase.php';

//递增的三元子数列
class Solution extends \algorithm\base\AlgorithmBase
{	//维护第一小第二小
	function increasingTriplet($nums) {
		$length = count($nums);
		if($length < 3)return false;
		$first = PHP_INT_MAX;
		$second = PHP_INT_MAX;
		foreach($nums as $num){
			if($num <= $first){
				$first = $num;
			}else if($num <= $second){
				$second = $num;
			}else{
				return true;
			}
				
		}
		
		return false;
	}
	
	//堆栈
	function increasingTriplet1($nums) {
		$length = count($nums);
		if($length < 3)return false;
		$min = $nums[0];
		$stack = [];
		for($i = 1;$i < $length;$i++){
			$cur = $nums[$i];
			if($cur > $min){
				foreach($stack as $list){
					if($cur > end($list)){
						$list[] = $cur;
						if(count($list) == 3)
							return true;
					}
				}
				$area = [$min,$cur];
				if(empty($stack)||!in_array($area,$stack)){
					$stack[] = $area;
				}
			}else
			{
				$min = $cur;
			}
		}
		return false;
	}
/* 	function increasingTriplet($nums) {
	    $length = count($nums);
		if($length < 3)return false;
		$stack = [[$nums[0]]];
		for($i = 1;$i < $length;$i++){
			$cur = $nums[$i];
			$s_length = count($stack);
			for($j =0;$j < $s_length;$j++){
				$list = $stack[$j];
				if(!in_array($cur,$list)){
					$first = current($list);
					$end = end($list);
					if($cur > $end){
						$list[] = $cur;
						$stack[$j] = $list;
					}else
					{
						if($cur >$first){
							array_pop($list);
							$list[] = $cur;
							$stack[$j] = $list;
						}else{
							$stack[]=[$cur];
						}
					}
				}
				if(count($list) == 3)
					return true;
			}
		}
		
		return false;
	} */
	
	function test(){
		echo($this->increasingTriplet([1,2,3,4,5])).PHP_EOL;
		echo($this->increasingTriplet([5,4,3,2,1])).PHP_EOL;
		echo($this->increasingTriplet([5,1,5,5,2,5,4])).PHP_EOL;
		echo($this->increasingTriplet([1,0,10,0,10000])).PHP_EOL;
	}
}

(new Solution())->test();