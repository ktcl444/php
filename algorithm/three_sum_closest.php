<?php

require_once 'base\AlgorithmBase.php';

//最接近的三数之和-左右指针
class Solution extends \algorithm\base\AlgorithmBase
{    
	function threeSumClosest($nums, $target) {
        $length = count($nums);
        sort($nums);
		if($nums[0] > $target && $nums[0]>=0)return $nums[0]+$nums[1]+$nums[2];
        $res = 0;
        $min = PHP_INT_MAX;
        for($i = 0;$i < $length;$i++){
            if($i > 0 && $nums[$i] == $nums[$i -1])
                continue;
            $l = $i+1;
            $r = $length - 1;
            $temp_min = $nums[$i]+$nums[$l]+$nums[$l+1];
			if($temp_min > $target){
                if(abs($temp_min - $target) < $min){
                    $min = abs($temp_min - $target);
                    $res = $temp_min;
                }
				continue;
			}
			$temp_max = $nums[$i]+$nums[$r]+$nums[$r-1];
			if($temp_max < $target){
                if(abs($temp_max - $target) < $min){
                    $min = abs($temp_max - $target);
                    $res = $temp_max;
                }
				continue;
			}
            while($l < $r){
                $sum = $nums[$i] + $nums[$l] + $nums[$r];
                $differ = $target - $sum;
                if($differ == 0)
                    return $sum;
                if(abs($differ) < $min){
                    $min = abs($differ);
                    $res = $sum;
                }

                if($differ > 0){
                    $l++;
                }else{
                    $r--;
                }
            }
        }

        return $res;
    }
	function test(){
		echo ($this->threeSumClosest([-100,-98,-2,-1],-101)).PHP_EOL;
	}
	
}
(new Solution())->test();