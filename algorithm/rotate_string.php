<?php

require_once 'base\AlgorithmBase.php';
//旋转字符串-字符串拼接
class Solution extends \algorithm\base\AlgorithmBase
{
    function rotateString($A, $B) {
        if(strlen($A) != strlen($B))return false;
        return $A == $B || strpos($A.$A,$B) !== false;
    }
	function test(){
		echo($this->rotateString('','')).PHP_EOL;
	}
}

(new Solution())->test();