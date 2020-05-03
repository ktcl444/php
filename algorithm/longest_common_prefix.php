<?php

require_once 'base\AlgorithmBase.php';

//最长公共前缀-水平扫描
class Solution extends \algorithm\base\AlgorithmBase
{
	function longestCommonPrefix($strs){
		$min_length = PHP_INT_MAX;
		foreach($strs as $str){
			$min_length = min($min_length,strlen($str));
		}
		if($min_length == 0 || $min_length == PHP_INT_MAX)
			return '';
		
		$prefix = '';
		for($i = 0;$i < $min_length;$i++){
			$temp = '';
			foreach($strs as $str){
				$char = $str[$i];
				if($temp == '')
					$temp = $char;
				if($char != $temp)
					return $prefix;
			}
			$prefix .= $temp;
		}
		
		return $prefix;
	}
	
	function test(){
		echo $this->longestCommonPrefix(["flower","flow","flight"]	).PHP_EOL;
		echo $this->longestCommonPrefix(["dog","racecar","car"]).PHP_EOL;
	}
}

(new Solution())->test();