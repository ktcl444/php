<?php

require_once 'base\AlgorithmBase.php';

//字符串转换为整数-堆栈
class Solution extends \algorithm\base\AlgorithmBase
{
	function myAtoi($str){
		$str = trim($str);
		if(empty($str))return 0;	
		$length = strlen($str);
		$sign = '+';
		$stack = [];
		if($str{0} == '+' || $str{0} == '-'){
			$sign = $str{0};
		}else if(is_numeric($str{0})){
			$stack[] = $str{0};
		}else{
			return 0;
		}
		for($i = 1;$i < $length;$i++){
			$char = $str{$i};
			if(is_numeric($char)){
				$stack[] = $char;
			}else{
				break;
			}
		}
		$result = 0;
		while(!empty($stack)){
			$num = array_shift($stack);
			$result = $result * 10 + $num;
		}
		$min = -pow(2,31);
		$max = pow(2,31)-1;
		if($sign == '-')
			$result = -$result;
		if($result > $max)
			return $max;
		if($result < $min)
			return $min;
		
		return $result;
	}
	
    function test()
    {		echo($this->myAtoi('-10Abc')).PHP_EOL;
		echo($this->myAtoi('+20+-567')).PHP_EOL;
		echo($this->myAtoi('Abc321')).PHP_EOL;
		echo($this->myAtoi('+234')).PHP_EOL;
    }
}

(new Solution())->test();