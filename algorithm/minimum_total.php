<?php

require_once 'base\AlgorithmBase.php';
//三角形最小路径和-动态规划(从上往下/从下往上)
class Solution extends \algorithm\base\AlgorithmBase
{
	//从上往下
    function minimumTotal2($triangle) {
        $len = count($triangle);
        $dp = array_fill(0,$len,PHP_INT_MAX);
        $dp[0] = $triangle[0][0];
        for($i = 1;$i < $len;$i++){
            $dp[$i] = $dp[$i-1]+$triangle[$i][$i];
            for($j = $i - 1;$j > 0;$j--){
                $dp[$j] = min($dp[$j-1],$dp[$j]) + $triangle[$i][$j];
            }
            $dp[0] += $triangle[$i][0];
        }
        return min($dp);
    }

	//从下往上
	function minimumTotal($triangle) {
        $len=count($triangle);
        if($len==0)return 0;
        if($len==1)return $triangle[0][0];
        $dp=array_fill(0,$len+1,0);
        for($i=$len-1;$i>=0;$i--){
            for($j=0;$j<=$i;$j++){
                $dp[$j]=min($dp[$j],$dp[$j+1])+$triangle[$i][$j];
            }
        }
       
        return $dp[0];
    }
		

	function test(){
		
		echo($this->minimumTotal([[2],[3,4],[6,5,7],[4,1,8,3]])).PHP_EOL;
		echo($this->minimumTotal([[-1],[2,3],[1,-1,-3]])).PHP_EOL;
	}
}

(new Solution())->test();