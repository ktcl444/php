<?php

require_once 'base\AlgorithmBase.php';

//最小覆盖子串
class Solution extends \algorithm\base\AlgorithmBase
{
    function minWindow($s, $t) {
		if(empty($s) || empty($t)) return '';
		$dic = [];
		for($i=0;$i<strlen($t);$i++)
		{
			$dic[$t[$i]]++;
		}
		//print_r($dic);
		$required = count($dic);
		$char_index = [];
		for($i = 0;$i<strlen($s);$i++)
		{
			if(array_key_exists($s[$i],$dic))
			{
				$char_index[] = [$s[$i],$i];
			}
		}
		//print_r($char_index);
		$l = 0;$r = 0;$equal = 0;$window_count = [];
		$ans = [-1,0,0];
		
		while($r < count($char_index)){
			$char = $char_index[$r][0];
			$window_count[$char]++;
			
			if($window_count[$char] == $dic[$char]){
				$equal++;
			}
			
			while($l <= $r && $equal == $required)
			{
				//print_r($equal);
				$char = $char_index[$l][0];
				
				$end = $char_index[$r][1];
				$start = $char_index[$l][1];
				$length = $end-$start +1;
				if($ans[0] == -1 || $ans[0] > $length)
				{
					$ans = [$length,$start,$end];
				}
				
				$window_count[$char]--;
				if($window_count[$char]<$dic[$char])
				{
					$equal--;
				}
				$l++;
			}
			$r++;

		}
		return $ans[0] == -1 ? '':(substr($s,$ans[1],$ans[2]-$ans[1]+1));
	}
	
	function test(){
		echo $this->minWindow('ADOBECODEBANC','ABC').PHP_EOL;
		echo $this->minWindow('a','a').PHP_EOL;
		echo $this->minWindow('ab','a').PHP_EOL;;
		echo $this->minWindow('aa','aa').PHP_EOL;
	
	
		echo $this->minWindow('bb','ab').PHP_EOL;
	}
}

(new Solution())->test();