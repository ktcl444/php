<?php

require_once 'base\AlgorithmBase.php';
//统计字典序元音字符串的数目-dp
class Solution extends \algorithm\base\AlgorithmBase
{    
    function countVowelStrings1($n) {
        if($n == 1)return 5;
		$a = 5;
		$e=4;
		$i = 3;
		$o=2;
		$u=1;
		$ans = 0;
		for($index = 2;$index <= $n;$index++){
			$ans = $a+$e+$i+$o+$u;
			$a = $ans;
			$e = $e + $i + $o + $u;
			$i = $i + $o + $u;
			$o = $o + $u;
			$u = $u;
		}
		
		return $ans;
    }
	
	function countVowelStrings($n){
		$dp = [1,1,1,1,1];
		for($i = 1;$i < $n;$i++){
			for($j = 0;$j <5;$j++){
				for($k = $j + 1;$k < 5;$k++){
					$dp[$j]+= $dp[$k];
				}
			}
		}
		
		return array_sum($dp);
	}

	function test(){
		echo ($this->countVowelStrings(33)).PHP_EOL;
	}
}

(new Solution())->test();