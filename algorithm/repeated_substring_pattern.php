<?php

require_once 'base\AlgorithmBase.php';
//重复的子字符串-双指针
class Solution extends \algorithm\base\AlgorithmBase
{
    function repeatedSubstringPattern($s) {
        $len = strlen($s);
        $l = 0;
        $r = $len -1;
        while($l < $r){
            $left = substr($s,0,$l + 1);
            $right = substr($s,$r);
            if($left == $right){
				echo $left.PHP_EOL;
                if($len % ($l + 1) == 0){
                    $time = $len / ($l + 1);
                    $sub = '';
                    while($time > 0){
                        $sub .= $left;
                        $time--;
                    }
					echo $sub.PHP_EOL;
                    if($sub == $s)
                        return true;
                }
            }

            $l++;
            $r--;
        }

        return false;
    }
	function test(){
		
		echo($this->repeatedSubstringPattern('abab') ? '1':'0').PHP_EOL;
	}
}

(new Solution())->test();