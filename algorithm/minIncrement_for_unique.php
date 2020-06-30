<?php

require_once 'base\AlgorithmBase.php';
//使数组唯一的最小增量-排序+计数
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 排序
    function minIncrementForUnique($A) {
        sort($A);
        $length = count($A);
        $pre = $A[0];
        $count = 0;
        for($i = 1;$i < $length;$i++){
            $cur = $A[$i];
            if($cur <= $pre){
                $count += $pre + 1 - $cur;
                $cur = $pre + 1;
            }
            $pre = $cur;
        }

        return $count;
    }
	#endregion
	
	#region  计数
	function minIncrementForUnique1($A) {
		 $mapping = array_fill(0,80000,0);
		 foreach($A as $i){
			 $mapping[$i]++;
		 }
		$res = 0;
		$taken = 0;
		for($x = 0;$x < 80000;$x++){
			if($mapping[$x] >= 2){
				$taken += $mapping[$x] - 1;
				$res -= $x * ($mapping[$x] - 1);
			}
			if($mapping[$x] == 0 && $taken > 0){
				$taken--;
				$res += $x;
			}
		}
		
		return $res;
	}
	#endregion
	
	function test(){
		echo ($this->minIncrementForUnique([3,2,1,2,1,7])).PHP_EOL;
	}
}

(new Solution())->test();
