<?php

require_once 'base\AlgorithmBase.php';

//反转字符串中的单词
class Solution extends \algorithm\base\AlgorithmBase
{
    function reverseWords($s) {
        $array = explode(' ',$s);
		//print_r($array);
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
		//echo ' s:'.$s.' len:'.$length.' l:'.$left.' r:'.$right.PHP_EOL;
		while($left < $right){
			//echo 'l:'.$s{$left}.' r:'.$s{$right}.PHP_EOL;
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