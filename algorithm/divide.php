<?php

require_once 'base\AlgorithmBase.php';

//两数相除-递归
class Solution extends \algorithm\base\AlgorithmBase
{
    function divide($dividend, $divisor) {
		$sign = ($dividend < 0 && $divisor > 0) ||($dividend > 0 && $divisor < 0) ?'-' : '+';
		$result = $this->helper(abs($dividend),abs($divisor));
		$res = $result[0];
		if($sign == '+'){
			$max = pow(2,31)-1;
			if($res > $max)
				$res = $max;
		}else{
			$min = -pow(2,31);
			$res = -$res;
			if($res <$min)
				$res = $min;
		}
		return $res;
    }
	
	function helper($dividend, $divisor) {
		if($dividend == $divisor) return [1,0];
		$temp = $dividend ;
        $half = $dividend >> 1;
		if($half >= $divisor){
			$result = $this->helper($half,$divisor);
			$res = $result[0] << 1;
			$dividend = ($result[1]<<1) + ($temp - ($half << 1));
		}else{
			$res = 0;
			$dividend = $temp;
		}
		while($dividend >= $divisor){
			$dividend = $dividend - $divisor;
			$res++;
		}
		return [$res,$dividend];
    }
	
    function test()
    {		
		echo($this->divide(3,1)).PHP_EOL;
		echo($this->divide(2147483647,1)).PHP_EOL;
		echo($this->divide(10,3)).PHP_EOL;
		echo($this->divide(7,-3)).PHP_EOL;
    }
}

(new Solution())->test();