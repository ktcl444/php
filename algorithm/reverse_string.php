<?php

require_once 'base\AlgorithmBase.php';

//反转字符串
class Solution extends \algorithm\base\AlgorithmBase
{
	function reverseString(&$s){
		$length = count($s);
		if($length <=1)return;
		
		$left = 0;
		$right = $length - 1;
		while($left < $right){
			$temp = $s[$left];
			$s[$left++] = $s[$right];
			$s[$right--] = $temp;
		}
	}
	function test(){
		$s = ["h","e","l","l","o"];
		$this->reverseString($s);
		print_r($s);
	}
}

(new Solution())->test();