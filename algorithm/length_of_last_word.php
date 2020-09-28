<?php

require_once 'base\AlgorithmBase.php';
//最后一个单词-分割数组
class Solution extends \algorithm\base\AlgorithmBase
{
    function lengthOfLastWord($s) {
      
        return strlen(end(explode(' ',trim($s))));
    }
		

	function test(){
		echo($this->lengthOfLastWord('a ')).PHP_EOL;
	}
}

(new Solution())->test();