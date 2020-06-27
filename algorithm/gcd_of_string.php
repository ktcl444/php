<?php

require_once 'base\AlgorithmBase.php';
//字符串的最大公因子-最大公约数
class Solution extends \algorithm\base\AlgorithmBase
{
	function gcdOfStrings($str1, $str2) {
        $l = strlen($str1);
        $r = strlen($str2);
        if($str1.$str2 != $str2.$str1)return '';

        return substr($str1,0,$this->gcd($l,$r));
    }
	
    function gcd($m,$n){
        while($n != 0){
            $r = $m % $n;
            $m = $n;
            $n = $r;
        }

        return $m;
    }
   	
	function test(){
		echo($this->gcdOfStrings('ABCABC','ABC')).PHP_EOL;
	}
}

(new Solution())->test();