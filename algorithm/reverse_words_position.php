<?php

require_once 'base\AlgorithmBase.php';

//翻转字符串里的单词
class Solution extends \algorithm\base\AlgorithmBase
{
    function reverseWords($s) {
        $temp = explode(' ',$s);
		$temp = array_filter($temp);
		return implode(' ',array_reverse($temp));
    }
	
	function test(){
		print_r($this->reverseWords('the sky is blue'));
	}
}

(new Solution())->test();