<?php

require_once 'base\AlgorithmBase.php';

//验证回文字符串
class Solution extends \algorithm\base\AlgorithmBase
{
    function isPalindrome($s) {
		$s = preg_replace( '/[\W]/', '', $s); 
		$s = strtolower($s);
		$l = 0;
		$r = strlen($s)-1;
		while($l < $r){
			if($s[$l++] != $s[$r--]){
				return false;
			}
		}
		return true;
    }
	
	function test(){
		echo ($this->isPalindrome('A man, a plan, a canal: Panama') ? 'true': 'false').PHP_EOL;
		echo ($this->isPalindrome('race a car') ? 'true': 'false').PHP_EOL;
	}
}

(new Solution())->test();