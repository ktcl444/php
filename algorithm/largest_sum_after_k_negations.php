<?php

require_once 'base\AlgorithmBase.php';
//K 次取反后最大化的数组和
class Solution extends \algorithm\base\AlgorithmBase
{
	function largestSumAfterKNegations($A, $K) {
        sort($A);
        $len = count($A);
		$sum = 0;
		$cur = 0;
		$min = 101;
        while($cur < $len){
			if($K > 0 && $A[$cur] <=0){
				$K--;
				$A[$cur] = -$A[$cur];
			}
			$sum += $A[$cur];
			echo 'cur:'.$cur.' v:'.$A[$cur].PHP_EOL;
			$min = min($min,$A[$cur]);
            $cur++;
        }
		if($K % 2 ==1){
			echo $min.PHP_EOL;
			$sum -= $min * 2;
		}
        return $sum;
    }
	function test(){
		
		echo($this->largestSumAfterKNegations([8,-7,-3,-9,1,9,-6,-9,3],8)).PHP_EOL;
	}
}

(new Solution())->test();