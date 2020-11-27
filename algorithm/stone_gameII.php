<?php

require_once 'base\AlgorithmBase.php';
//石子游戏-动态规划(自底向上)
class Solution extends \algorithm\base\AlgorithmBase
{
    function stoneGameII($piles) {
        $len = count($piles);
        $dp = array_fill(0,$len,array_fill(0,$len+1,0));
        $sum = 0;
        for($i = $len - 1;$i >= 0;$i--){
            $sum += $piles[$i];
            for($m = 1;$m<=$len;$m++){
                if($i + 2*$m >= $len){
                    $dp[$i][$m] = $sum;
                }else{
                    for($x = 1;$x <= 2 *$m;$x++){
                        $n_m = max($m,$x);
                        $dp[$i][$m] = max($dp[$i][$m],$sum - $dp[$i+$x][$n_m]);
                    }
                }
            }
        }
        return $dp[0][1];
    }
		

	function test(){
		print_r($this->stoneGameII([2,7,9,4,4]));
	}
}

(new Solution())->test();