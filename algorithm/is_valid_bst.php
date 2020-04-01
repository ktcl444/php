<?php

require_once 'base\AlgorithmBase.php';

//[字典序下一个排列-降序变升序]
class Solution extends \algorithm\base\AlgorithmBase
{
    function isValidBST($root) {
        
    }
	function test(){
		echo $this->isValidBST(self::conv)
	}
}

(new Solution())->test();