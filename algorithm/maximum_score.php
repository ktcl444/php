<?php

require_once 'base\AlgorithmBase.php';
// 移除石子的最大得分-两边之和大于第三边
class Solution extends \algorithm\base\AlgorithmBase
{    
    function maximumScore($a, $b, $c) {
        $list = [$a,$b,$c];
        sort($list);
        $a = $list[0];
        $b = $list[1];
        $c = $list[2];
        //2堆小的全部取完
		if($a + $b <= $c)
            return $a + $b;
		//三角形
        return ($a + $b + $c) >> 1;
    }
	
	//递归
    function maximumScore2($a, $b, $c) {
             $zero = 0;
        $zero += $a == 0 ? 1: 0;
        $zero += $b == 0 ? 1: 0;
        $zero += $c == 0 ? 1: 0;
        if($zero >= 2)
            return 0;
        if($zero == 1)
            return $a == 0 ? min($b,$c) : ($b == 0 ? min($a,$c) : min($a,$b));
        $list = [$a,$b,$c];
        sort($list);
        $list[0] -= 1;
        $list[2] -= 1;
        return $this->maximumScore($list[0],$list[1],$list[2])+1;
    }

	function test(){
		echo($this->maximumScore2(2,4,6)).PHP_EOL;
		echo($this->maximumScore2(4,4,6)).PHP_EOL;
		echo($this->maximumScore2(8,8,1)).PHP_EOL;
	}
}

(new Solution())->test();