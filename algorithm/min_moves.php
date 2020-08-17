<?php

require_once 'base\AlgorithmBase.php';
//最小移动次数使数组元素相等-数学/dp/排序/暴力
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 数学方法	//将除了一个元素之外的全部元素+1，等价于将该元素-1，因为我们只对元素的相对大小感兴趣。因此，该问题简化为需要进行的减法次数。
    function minMoves($nums) {
        return array_sum($nums)- min($nums) * count($nums);
    }
	#endregion
	
	#region DP
    function minMoves1($nums) {
        sort($nums);
        $len = count($nums);
        $move = 0;
        for($i = 1;$i < $len;$i++){
            $diff = $nums[$i] + $move - $nums[$i-1];
			$nums[$i] += $move;
			$move += $diff;
        }
        return $move;
    }
	#endregion
	
	#region 排序
    function minMoves2($nums) {
        sort($nums);
        $len = count($nums);
        $move = 0;
        for($i = $len - 1;$i > 0 ;$i--){
            $move += ($nums[$i] - $nums[0]);
        }
        return $move;
    }
	#endregion
	
	#region 暴力
	    function minMoves3($nums) {
        $len = count($nums);
        $max = $len-1;
        $min = 0;
        $move = 0;
        while(true){
            foreach($nums as $index=> $num){
                if($nums[$index] > $nums[$max]){
                    $max = $index;
                }
                if($nums[$index] < $nums[$min]){
                    $min = $index;
                }
            }
            $diff = $nums[$max] - $nums[$min];
            if($diff == 0){
                break;
            }
            foreach($nums as $index=> $num){
                if($index != $max){
                    $nums[$index] += $diff;
                }
            }
            $move+=$diff;
        }

        return $move;
    }
	#endregion
	

	function test(){
		echo( $this->minMoves([1,2,3])).PHP_EOL;
	}
}

(new Solution())->test();