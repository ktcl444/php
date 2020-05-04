<?php

require_once 'base\AlgorithmBase.php';

//计算质数-排除法
class Solution extends \algorithm\base\AlgorithmBase
{
    function countPrimes($n) {
		if ($n <= 1) 
			return 0;
		
		$is_primes = array_fill(2,$n-2,true);
		$count = 0;
		for($i = 2;$i * $i < $n;$i++){
			if($is_primes[$i]){
				for($j = $i * $i;$j < $n ;$j += $i){
					$is_primes[$j] = false;
				}
			}
		}
/* 		$count = 0;
		for($i = 2;$i < $n;$i++){
			if($is_primes[$i])
				$count++;
		} 
		return $count;
		*/
		return array_sum($is_primes);
	}
	
	function test(){
		/* for($i  = 0;$i < 101;$i++){
			echo $i.' :' .($this->isPrimes($i)?'Y':'N').PHP_EOL;
		} */
		echo $this->countPrimes(10).PHP_EOL;
		echo $this->countPrimes(100).PHP_EOL;
		echo $this->countPrimes(1000).PHP_EOL;
		echo $this->countPrimes(10000).PHP_EOL;
		echo $this->countPrimes(500000).PHP_EOL;
	}
}

(new Solution())->test();