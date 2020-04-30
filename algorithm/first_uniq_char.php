<?php

require_once 'base\AlgorithmBase.php';

//字符串中的第一个不重复的字符-字典
class Solution extends \algorithm\base\AlgorithmBase
{
	function firstUniqChar($s) {
		$length = strlen($s);
		if($length == 1)return 0;
		$index = 0;
		$mapping = [];
		$position = [];
		while($index < $length){
			$char = $s[$index];
			$mapping[$char]++;
			!isset($position[$char]) && $position[$char] = $index;
			$index++;
		}
		foreach($mapping as $char => $count){
			if($count == 1){
				return $position[$char];
			}
		}
		
		return -1;
    }
	
	function test(){
		echo $this->firstUniqChar('leetcode').PHP_EOL;
		echo $this->firstUniqChar('loveleetcode').PHP_EOL;
	}
}

(new Solution())->test();