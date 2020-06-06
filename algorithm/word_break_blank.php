<?php
require 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{	
	private $map = [];
	function wordBreak($s, $wordDict) {
		return $this->dfs($s,0,$wordDict);
	}
	
	function dfs($s,$start,$dict){
		if(array_key_exists($start,$this->map))
			return $this->map[$start];
		$res = [];
		if($start == strlen($s)){
			$res[] = '';
		}
		
		for($end = $start + 1;$end <= strlen($s);$end++){
			$ss =  substr($s,$start,$end-$start);
			if(in_array($ss,$dict)){
				$list = $this->dfs($s,$end,$dict);
				foreach($list as $string){
					$res[] = $ss . (empty($string) ? '':' ') .$string;
				}
			}
		}
		$this->map[$start] = $res;
		return $res;
	}
	
	function test(){
		print_r($this->wordBreak('catsanddog',["cat", "cats", "and", "sand", "dog"]));
		print_r($this->wordBreak('pineapplepenapple',["apple", "pen", "applepen", "pine", "pineapple"]));
		print_r($this->wordBreak('catsandog',["cats", "dog", "sand", "and", "cat"]));
	}
}

(new  Solution)->test();

