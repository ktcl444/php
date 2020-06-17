<?php

require_once 'base\AlgorithmBase.php';

//反转字符串中的单词
class Solution extends \algorithm\base\AlgorithmBase
{
    function reverseWords($s) {
        $array = explode(' ',$s);
		foreach($array as $key => $string){
			$this->reverseString($string);
			$array[$key] = $string;
		}
		
		return implode(' ',$array);
    }
	
	function reverseString(&$s){
		$length = strlen($s);
		if($length <= 1)return;
		
		$left = 0;
		$right = $length - 1;
		while($left < $right){
			$temp = $s{$left};
			$s{$left++} = $s{$right};
			$s{$right--} = $temp;
		}
	}

	
	function test(){
		echo ($this->reverseWords("Let's take LeetCode contest")).PHP_EOL;		
	}
}
(new Solution())->test();