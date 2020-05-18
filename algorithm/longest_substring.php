<?php

require_once 'base\AlgorithmBase.php';

//至少有K个重复字符的最长子串
class Solution extends \algorithm\base\AlgorithmBase
{
	  function longestSubstring($s, $k) {
		$char_map = [];
		$length = strlen($s);
		for($i = 0;$i < $length;$i++){
			$char_map[$s[$i]]++;
		}
		
		$split = [];
		for($i = 0;$i < $length;$i++){
			if($char_map[$s[$i]]<$k)
				$split[] = $i;
		}
		if(empty($split))return $length;
		
		$split[] = $length;
		$max = 0;
		$left = 0;
		for($i = 0;$i < count($split);$i++){
			$len = $split[$i] -$left;
			if($len > $max) 
				$max = max($max,$this->longestSubstring(substr($s,$left,$len),$k));
			$left = $split[$i]+1;
		}
		
		return $max;
	  }
/*     function longestSubstring($s, $k) {
        $char_map = [];
		$length = strlen($s);
		for($i = 0;$i < $length;$i++){
			$char = $s[$i];
			$char_map[$char]++;
		}
		//print_r($char_map);
		$left = 0;
		$right = 0;
		$max = 0;
		$cur_mapping = [];
		$success = false;
		while($right < $length){
			$char = $s[$right];
			$cur_mapping[$char]++;
			if(($success && $cur_mapping[$char] >= $k) || $this->checkSuccess($cur_mapping,$k)){
				$success = true;
				$max = max($max,$right - $left + 1);
			}else{
				if($char_map[$char] < $k){
					$success = false;
					$cur_mapping[$char]--;
					while($left < $right){
						$cur_mapping[$s[$left++]]--;
						//print_r($cur_mapping);
						if($this->checkSuccess($cur_mapping,$k)){
							$max = max($max,$right - $left );
						}
					}
					$left = $right+1;
					$cur_mapping = [];
				}
			}
			$right++;
			//print_r($cur_mapping);
		}
		
		return $max;
    } 
	
	function checkSuccess($mapping,$k){
		foreach($mapping as $count){
			if($count > 0 && $count < $k){
				return false;
			}
		}
		
		return true;
	}*/

	function test(){
		echo($this->longestSubstring('aaabb',3).PHP_EOL);
		echo($this->longestSubstring('ababbc',2).PHP_EOL);
		echo($this->longestSubstring('bbaaacbd',3).PHP_EOL);
	}
}

(new Solution())->test();