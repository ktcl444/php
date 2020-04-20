<?php

require_once 'base\AlgorithmBase.php';

//字母异位词分组
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 排序树组分类
    function groupAnagrams1($strs) {
        if(empty($strs)) return [];
		
		$length = count($strs);
		$result = [];
		for($i = 0;$i < $length;$i++){
			$word = $strs[$i];
			$word_array = $this->wordToArray($word);
			if(!array_key_exists($word_array,$result)){
				$result[$word_array] = [];
			}
			$result[$word_array][] = $word;
		}
		return array_values($result);
    }
	
	function wordToArray($word){
		$array = str_split($word,1);
		sort($array);
		return implode('',$array);
	}
	#endregion
	
	#region 计数分类
	function groupAnagrams($strs) {
		if(empty($strs)) return [];
		
		$length = count($strs);
		$result = [];
		for($i = 0;$i < $length;$i++){
			$word = $strs[$i];
			$word_array = $this->wordToCount($word);
			echo 'w:'.$word.' n:'.$word_array.PHP_EOL;
			if(!array_key_exists($word_array,$result)){
				$result[$word_array] = [];
			}
			$result[$word_array][] = $word;
		}
		return array_values($result);	
	}
	
	function wordToCount($word){
		$array = str_split($word,1);
		$count = array_fill(0,26,0);
		$start = ord('a');
		foreach($array as $char){
			$count[ord($char) - $start]++;
		}
		$s = [];
		foreach($count as $num){
			$s[] = '#';
			$s[] = $num;
		}
		return implode('',$s);
	}
	#endregion
	
	function test(){
		print_r($this->groupAnagrams(["eat", "tea", "tan", "ate", "nat", "bat"]));
	}
}

(new Solution())->test();