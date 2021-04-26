<?php

require_once 'base\AlgorithmBase.php';
// 每个元音包含偶数次的最长子字符串-二进制/暴力
class Solution extends \algorithm\base\AlgorithmBase
{   	
	//1 二进制
	function findTheLongestSubstring($s) {
		$max = 1 << 5;
		$map = array_fill(0,$max,PHP_INT_MAX);
		$mask =$ans = 0;
		$map[0] = -1;
		for($i = 0,$len = strlen($s);$i < $len;$i++){
			switch($s{$i}){
				case 'a':
					$mask ^= 1<<0;
					break;
				case 'e':
					$mask ^= 1<<1;
					break;
				case 'i':
					$mask ^= 1<<2;
					break;
				case 'o':
					$mask ^= 1<<3;
					break;
				case 'u':
					$mask ^= 1<<4;
					break;
			}
			if($map[$mask] == PHP_INT_MAX)
				$map[$mask] = $i;
			else
				$ans = max($ans,$i - $map[$mask]);
		}
		
		return $ans;
			
	}
	//2 暴力
    function findTheLongestSubstring2($s) {
        $len = strlen($s);
        $check = ['a','e','i','o','u'];
        $seqs = array_fill(0,$len,array_fill(0,5,0));
       
        for($j = 0;$j < 5;$j++){
            $num = 0;
            $char = $check[$j];
            for($i = 0;$i < $len;$i++){
                if($s{$i} == $char){
                    $num++;
                }
                $seqs[$i][$j] = $num;
            }
        }
		print_r($seqs);
        $ans = 0;
        for($l = 0;$l < $len;$l++){
            for($r = $l;$r < $len;$r++){
                $flag = true;
                for($k = 0;$k < 5;$k++){
                    $diff = $seqs[$r][$k] - ($l == 0 ? 0 : $seqs[$l-1][$k]);
                    if($diff % 2 != 0){
                        $flag = false;
                        break;
                    }
                }
                if($flag){
                    $ans = max($ans,$r-$l+1);
                }
            }
        }
        return $ans;
    }

	function test(){
		echo( $this->findTheLongestSubstring('eleetminicoworoep')).PHP_EOL;
	}
}

(new Solution())->test();