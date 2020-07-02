<?php

require_once 'base\AlgorithmBase.php';

//硬币-动态规划+数学
class Solution extends \algorithm\base\AlgorithmBase
{
	//动态规划
	//f(i,v) = f(i - 1, v - 0 * c_i),f(i - 1, v - 1 * c_i), f(i - 1, v - 2 * c_i) ... f(i - 1, v - k * c_i)
	//v-c_i 替换v
	//f(i,v−c_i)=f(i−1,v−c_i)+f(i−1,v−2c_i)+f(i−1,v−3c_i)⋯f(i−1,v−kc_i)
	//f(i,v) = f(i-1,v) + f(i,v-c_i)
    function waysToChange($n) {
        $mod = 1000000007;
        $coins = [25,10,5,1];
        $dp = array_fill(0,$n+1,0);
        $dp[0] = 1;
        foreach($coins as $coin){
            for($i = $coin;$i <= $n;$i++){
				$dp[$i] = ($dp[$i] + $dp[$i - $coin]) % $mod;
			}
			print_r($dp);
        }
		
		return $dp[$n];
    }
	
	//数学
	function waysToChange($n) {
		$mod = 1000000007;
		$ans = 0;
		for($i = 0;$i * 25 <= $n;$i++){
			$rest = $n -$i * 25;
			$a = intval($rest / 10);
			$b = intval($rest % 10 / 5);
			$ans += ($a + $b + 1)*($a+1) % $mod;
		}
		
		return $ans;
	}
	
	function test(){
		echo ($this->waysToChange(25)).PHP_EOL;
	}
}

(new Solution())->test();