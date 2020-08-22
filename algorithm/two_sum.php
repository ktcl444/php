<?php

require_once 'base\AlgorithmBase.php';
//n个骰子的点数-dp
class Solution extends \algorithm\base\AlgorithmBase
{
	#region dp(一维)	    
	function twoSum($n) {
        $dp = [];
        for($i = 1;$i <= 6;$i++){
            $dp[$i] = 1;
        }
        for($i=2;$i <=$n ;$i++){
            for($j = $i*6;$j>=$i;$j--){
                $dp[$j] = 0;
                for($cur = 1;$cur <= 6;$cur++){
                    if($j - $cur < $i - 1){
                        break;
                    }
                    $dp[$j] += $dp[$j - $cur];
                }
            }
        }
        $base = pow(6,$n);
        $ans = [];
        for($i = $n;$i<= 6*$n;$i++){
            $ans[] = round($dp[$i]/$base,5);
        }

        return $ans;
    }
	#endregion
	
	#region DP(二维)
    function twoSum1($n) {
        $dp = [];
        for($i = 1;$i <= 6;$i++){
            $dp[1][$i] = 1;
        }
        for($i=2;$i <=$n ;$i++){
            for($j = $i;$j<=$i*6;$j++){
                for($cur = 1;$cur <= 6;$cur++){
                    if($j - $cur < $i - 1){
                        break;
                    }
                    $dp[$i][$j] += $dp[$i - 1][$j - $cur];
                }
            }
        }
        $base = pow(6,$n);
        $ans = [];
        for($i = $n;$i<= 6*$n;$i++){
            $ans[] = round($dp[$n][$i]/$base,5);
        }

        return $ans;
    }
	#endregion
	

	function test(){
		print_r( $this->twoSum(3));
		print_r( $this->twoSum1(3));
	}
}

(new Solution())->test();