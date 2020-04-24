<?php

require_once 'base\AlgorithmBase.php';

//反转二进制位
class Solution extends \algorithm\base\AlgorithmBase
{
	function reverseBits($n){
		$bit_array  = array_fill(0,32,0);
		$index = 31;
		$result = 0;
		while($n != 0){
			$bit_array[$index] = $n % 2;
			$n = intval($n / 2);
			
			if($bit_array[$index] == 1){
				$result += pow(2,$index);
			}
			$index--;
		}
		
		return $result;
	}
	function test(){
		echo $this->reverseBits(3).PHP_EOL;
	}
}

(new Solution())->test();