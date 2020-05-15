<?php

require_once 'base\AlgorithmBase.php';

//逆波兰表达式-堆栈
class Solution extends \algorithm\base\AlgorithmBase
{
    function evalRPN($tokens) {
		$stack = [];
		foreach($tokens as $token){
			switch($token){
				case '+':
					array_push($stack, intval(array_pop($stack) + array_pop($stack)));
					break;
				case '-':
					array_push($stack, intval(-array_pop($stack) + array_pop($stack)));
					break;
				case '*':
					array_push($stack, intval(array_pop($stack)*array_pop($stack)));
					break;
				case '/':
					$temp = array_pop($stack);
					array_push($stack, intval(array_pop($stack)/ $temp));
					break;
				default:
					array_push($stack,intval($token));
			};
		}
		
		return end($stack);
    }

	function test(){
		echo($this->evalRPN(["10", "6", "9", "3", "+", "-11", "*", "/", "*", "17", "+", "5", "+"]).PHP_EOL);
		
/* 		["10", "6", "12         ", "-11", "*", "/", "*", "17", "+", "5", "+"]
		["10", "6", "                    -132", "/", "*", "17", "+", "5", "+"]
		["10", "                                 0", "*", "17", "+", "5", "+"]
		["                                            0", "17", "+", "5", "+"]
		["													    17", "5", "+"]
		["																  22"] */
	}
}

(new Solution())->test();