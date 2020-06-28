<?php

require_once 'base\AlgorithmBase.php';
//按摩师-动态规划
class Solution extends \algorithm\base\AlgorithmBase
{
    function massage($nums) {
        $dp[-1] = 0;
        $dp[0] = $nums[0];
        $length = count($nums);
        for($i = 1; $i < $length;$i++){
            $dp[$i] = max($dp[$i-2] + $nums[$i],$dp[$i-1]);
        }

        return $dp[$length - 1];
    }
	

	function test(){
		echo($this->massage([2,1,4,5,3,1,1,3])).PHP_EOL;
	}
}

(new Solution())->test();