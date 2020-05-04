<?php

require_once 'base\AlgorithmBase.php';

//整数反转-弹出推入数字
class Solution extends \algorithm\base\AlgorithmBase
{
    function reverse($n) {
		$res = 0;
			$max = pow(2,31)-1;
			$min = -pow(2,31);
			$max_fact = intval($max /10);
			$min_fact = intval($min /10);
			$max_int = $max % 10 ;
			$min_int = $min % 10;
		while($n != 0){
			$pop = $n % 10;
			$n = intval($n/10);
			if($res > $max_fact || ($res == $max_fact && $pop  > $max_int))
				return 0;
			if($res < $min_fact ||($res == $min_fact && $pop < $min_int))
				return 0;
			$res = $res * 10 + $pop;
		}
		return $res;
    }
	
	function test(){
		echo $this->reverse(13456).PHP_EOL;
		echo $this->reverse(123).PHP_EOL;
		echo $this->reverse(-321).PHP_EOL;
	}
}

(new Solution())->test();