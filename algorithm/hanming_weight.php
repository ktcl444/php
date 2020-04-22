<?php

require_once 'base\AlgorithmBase.php';

//汉明重量-本体与本体-1
class Solution extends \algorithm\base\AlgorithmBase
{

    function hammingWeight($n) {
		$result = 0;
		while($n != 0){
			$result++;
			$n = $n & ($n - 1);
		}
		return $result;
    }
	
	function test(){
		echo $this->hammingWeight(3).PHP_EOL;
		echo $this->hammingWeight(224).PHP_EOL;
		echo $this->hammingWeight(998).PHP_EOL;
	}
}

(new Solution())->test();