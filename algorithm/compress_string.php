<?php

require_once 'base\AlgorithmBase.php';
//字符串压缩-模拟
class Solution extends \algorithm\base\AlgorithmBase
{
    function compressString($S) {
        $length = strlen($S);
        $char = '';
        $count = 0;
        $i = 0;
        $res  = '';
        while($i < $length){
            $cur = $S{$i++};
            if($cur != $char && $count > 0){
                $res .= $char.$count;
                $count = 0;
            }
            $char = $cur;
            $count++;
        }
           
        $res .= $char.$count;

        return strlen($res) >= $length ? $S : $res;
    }

	function test(){
		echo($this->compressString('aabcccccaaa')).PHP_EOL;
	}
}

(new Solution())->test();