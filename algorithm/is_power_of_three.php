<?php

require_once 'base\AlgorithmBase.php';

//3的幂-对数+循环
class Solution extends \algorithm\base\AlgorithmBase
{
	function isPowerOfThree($n) {
		$result = log($n,10)/log(3,10);
		return $result - intval($result) == 0;
    }
	
	function isPowerOfThree1($n) {
        $index = 0;
		$three = 1;
		while($three <= $n){
			if($three == $n)
				return true;
			$three = pow(3,++$index);
		}
		
		return false;
    }
	function test(){
		echo $this->isPowerOfThree(27)? '1':'0'.PHP_EOL;
		echo $this->isPowerOfThree(0)? '1':'0'.PHP_EOL;
	}
}

(new Solution())->test();