<?php

require_once 'base\AlgorithmBase.php';

//最大数-字符串排序
class Solution extends \algorithm\base\AlgorithmBase
{		
	#region 递归
    function myPow1($x, $n) {
		return $n >= 0 ? $this->quick_pow($x,$n) : 1 / $this->quick_pow($x,-$n);
    }
	
	
	function quick_pow1($x,$n){
		if($n ==0)return 1;
		$result = $this->quick_pow($x,$n/2);
		return $n % 2 == 0 ? $result * $result :$result * $result * $x;
	}
	#endregion
	
	#region 迭代
	function myPow($x, $n) {
		if($n < 0){
			$x = 1/$x;
			$n = -$n;
		}
		$result = 1;
		$t_x = $x;
		while($n > 0){
			if($n % 2 == 1){
				$result *= $t_x;
			}
			
			$t_x *= $t_x;
			$n = $n /2;
		}
		
		return $result;
	}
	#endregion
	function test(){
		echo($this->myPow(2.00000,10)).PHP_EOL;
		echo($this->myPow(2.10000,3)).PHP_EOL;
		echo($this->myPow(2.00000,-2)).PHP_EOL;
	}
}

(new Solution())->test();