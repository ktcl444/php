<?php

require_once 'base\AlgorithmBase.php';

//实现strstr
class Solution extends \algorithm\base\AlgorithmBase
{
    function strStr($haystack, $needle) {
        $l1 = strlen($haystack);
		$l2 = strlen($needle);
		if($l2 == 0)return 0;
		if($l1 == 0)return -1;
		if($l1 < $l2)return -1;
		
		for($i = 0;$i < $l1 - $l2 + 1;$i++){
			$l = $i;
			$r = 0;
			while($l < $l1 && $r < $l2){
				$rc = $needle[$r];
				$lc = $haystack[$l];
				if($lc == $rc){
					$l++;
					$r++;
				}else				{
					break;
				}
			}
			if($r == $l2)
				return $i;
		}
		
		return -1;
    }
	
	function test(){
		echo $this->strStr('hello','ll').PHP_EOL;
		echo $this->strStr('aaaaa','bba').PHP_EOL;
	}
}

(new Solution())->test();