<?php

require_once 'base\AlgorithmBase.php';
//比较含退格的字符串-数组比较
class Solution extends \algorithm\base\AlgorithmBase
{
    function findJudge($N, $trust) {
        $all = range(1,$N,1);
        $first = array_unique(array_column($trust,0));
        $diff = array_diff($all,$first);
        foreach($diff as $test){
				echo $test.PHP_EOL;
            $target = array_filter($trust,function($t)use($test){
				echo $test.PHP_EOL;
                return $t[1] == $test;
            });
            if(count($target) == $N - 1)
                return $test;
        }
       return -1;

    }
	function test(){
		echo($this->findJudge(2,[[1,2]])).PHP_EOL;
	}
}

(new Solution())->test();