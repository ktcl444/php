<?php

require_once 'base\AlgorithmBase.php';

//解码方法-动态规划
class Solution extends \algorithm\base\AlgorithmBase
{
	function numDecodings($s){
		$len = strlen($s);
		$dp[$len] = 1;
		if($s[$len-1] != 0)$dp[$len - 1] = 1;
		for($i = $len - 2;$i >= 0;$i--){
			if($s[$i] == 0){
				$dp[$i] = 0;
			}else{
				$dp[$i] = $dp[$i+1] + ($s[$i] * 10 + $s[$i + 1] <= 26 ? $dp[$i+2]:0);
			}
				
		}
		return $dp[0] ?? 0;
	}
	
    function test()
    {
		echo($this->numDecodings('0')).PHP_EOL;
    }
}

(new Solution())->test();