<?php

require_once 'base\AlgorithmBase.php';
//删除回文子字符串
class Solution extends \algorithm\base\AlgorithmBase
{
	function removePalindromeSub($s) {
        $len = strlen($s);
        if($len == 0)return $len;
		
        $dp = array_fill(0,$len,array_fill(0,$len,0));
        $max = 0;
        $max_s = '';
        for($r = 0;$r < $len;$r++){
            for($l = 0;$l <= $r;$l++){
                if($s{$l} == $s{$r} && ($r - $l <= 2 || $dp[$l+1][$r-1] == 1)){
                    $dp[$l][$r] = 1;
                    if($r - $l + 1 > $max){
                        $max = $r - $l + 1;
                        $max_s = substr($s,$l,$r-$l+1);
                    }
                }
            }
        }
        $s = str_replace($max_s,'',$s);
		//echo 'max:'.$max_s.' s:'.$s.PHP_EOL;
        return $this->removePalindromeSub($s)+1;
    }

	function test(){
		echo($this->removePalindromeSub ("abb")).PHP_EOL;
	}
}

(new Solution())->test();