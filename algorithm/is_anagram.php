<?php

require_once 'base\AlgorithmBase.php';

//有效的字母异位词
class Solution extends \algorithm\base\AlgorithmBase
{
	function isAnagram($s,$t){
		$length1 = strlen($s);
		$length2 = strlen($t);
		
		if($length1 != $length2)return false;
		
		$mapping = [];
		for($i = 0;$i < $length1;$i++){
			$char = substr($s,$i,1);
			$mapping[$char]++;
		}
		
		for($i = 0;$i < $length2;$i++){
			$char = substr($t,$i,1);
			if(array_key_exists($char,$mapping)){
				$mapping[$char]--;
			}else{
				return false;
			}
			if($mapping[$char]<0){
				return false;
			}
		}
		return true;
	}
	
	function test(){
		echo($this->isAnagram('anagram','nagaram')).PHP_EOL;
		echo($this->isAnagram('rat','car')).PHP_EOL;
	}
}

(new Solution())->test();