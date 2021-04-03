<?php

require_once 'base\AlgorithmBase.php';
//统计只差一个字符的子串数目-暴力
class Solution extends \algorithm\base\AlgorithmBase
{    
    function countSubstrings($s, $t) {
        $map = [];
        $lens = strlen($s);
        $lent = strlen($t);
        $ans = 0;
        for($i = 0;$i < $lens;$i++){
            for($j = 0;$j< $lent;$j++){
				$diff = 0;
                for($k=0;$i+$k<$lens && $j+$k<$lent;$k++){
					$diff += $s{$i+$k} == $t{$j+$k} ? 0 : 1; 
					if($diff > 1){
						break;
					}
					if($diff == 1)
						$ans++;

				}
            }
        }

        return $ans;
    }

    function check($s,$t,$len){
        if($s == $t)return false;
        $diff = 0;
        for($i = 0;$i < $len;$i++){
            if($s{$i} != $t{$i}){
                $diff++;
                if($diff > 1)
                    break;
            }
        }
        return $diff == 1;
    }

	function test(){
		echo ($this->countSubstrings('aba','baba')).PHP_EOL;
	}
}

(new Solution())->test();