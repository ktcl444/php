<?php

require_once 'base\AlgorithmBase.php';
//不同字符的最小子序列-贪心堆栈
class Solution extends \algorithm\base\AlgorithmBase
{   	

	function smallestSubsequence($s){
        $map = [];
        for($i = 0,$len = strlen($s);$i < $len;$i++){
            $map[$s{$i}]++;
			$exists[$s{$i}] = 0;
        }
		//print_r($map);
        
		$stack = [];
		$exists = [];
		for($i = 0;$i < $len;$i++){
			$char = $s{$i};
			//如果当前字符没有压入堆栈
			if($exists[$char]==0){
				//如果上一个字符比当前字符大
				while(!empty($stack) && end($stack) > $char){
					$pre = end($stack);
					//如果上一个字符后面还有
					if($map[$pre] >0){
						//去掉标识 压出堆栈
						$exists[$pre] = 0;
						array_pop($stack);
					}else{
						break;
					}
				}
				//压入堆栈并记录
				$exists[$char] = 1;
				$stack[] = $char;
			}
			//当前字符数量-1
			$map[$char]--;
		}
		//print_r($map);
		return implode('',$stack);
	}

	function test(){
		echo( $this->smallestSubsequence("cbacdcbc")).PHP_EOL;
	}
}

(new Solution())->test();