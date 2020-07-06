<?php

require_once 'base\AlgorithmBase.php';

//鸡蛋掉落-数学方法
class Solution extends \algorithm\base\AlgorithmBase
{
    // f(T,K)=1+f(T−1,K−1)+f(T−1,K)  T=尝试次数<=N
    //当 K≥1 时，f(1,K)=1。
    function superEggDrop($K, $N) {
        if ($N == 1) {
            return 1;
        }
        $f = array_fill(0,$N,array_fill(0,$K,0));
        for($i = 1; $i <= $K;$i++){
            $f[1][$i] = 1;
        }

        $ans = -1;
        for($i = 2;$i <= $N;$i++){
            for($j = 1;$j <= $K;$j++ ){
                $f[$i][$j] = 1 + $f[$i-1][$j-1] + $f[$i-1][$j];
            }
            if($f[$i][$K] >= $N){
                $ans = $i;
                break;
            }
        }

        return $ans;
    }
	
	
	function test(){

	}
}

(new Solution())->test();