<?php

require_once 'base\AlgorithmBase.php';
//最长公共子序列-动态规划
class Solution extends \algorithm\base\AlgorithmBase
{    
	function longestCommonSubsequence($text1, $text2) {
        $len1 = strlen($text1);
        $len2 = strlen($text2);
        $dp = array_fill(0,$len1+1,array_fill(0,$len2+1,0));
        for($i = 1; $i <= $len1;$i++){
            for($j = 1;$j <= $len2;$j++){
                if($text1{$i-1} == $text2{$j-1}){
					echo $i.' '.$j.PHP_EOL;
                    $dp[$i][$j] = $dp[$i-1][$j-1] + 1;
                }else{
                    $dp[$i][$j] = max($dp[$i-1][$j] ,$dp[$i][$j-1]);
                }
            }
        }
		//print_r($dp);
        return $dp[$len1][$len2];
    }

	function test(){
		echo($this->longestCommonSubsequence('abc','def')).PHP_EOL;
	}
}

(new Solution())->test();