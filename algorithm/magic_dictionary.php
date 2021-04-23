<?php

require_once 'base\AlgorithmBase.php';
// 实现一个魔法字典-暴力
class Solution extends \algorithm\base\AlgorithmBase
{   

	function test(){
		$dic = new MagicDictionary();
		$dic->buildDict(["hello",'hhllo', "leetcode"]);
		echo $dic->search('hello') ?  1 : 0;
		echo $dic->search('hallo') ?  1 : 0;
		echo $dic->search('hell') ?  1 : 0;
		echo $dic->search('leetcoded') ?  1 : 0;
	}
}

class MagicDictionary {
    /**
     * Initialize your data structure here.
     */
    private $map;
    function __construct() {
        $this->map = [];
    }

    /**
     * @param String[] $dictionary
     * @return NULL
     */
    function buildDict($dictionary) {
        foreach($dictionary as $s){
            $this->map[strlen($s)][] =$s;
        }
    }

    /**
     * @param String $searchWord
     * @return Boolean
     */
    function search($searchWord) {
        $len = strlen($searchWord);
		if(!array_key_exists($len,$this->map))
			return false;
		foreach($this->map[$len] as $s){
			
			$ans = 0;
			for($i =0;$i < $len;$i++){
				if($searchWord{$i} != $s{$i}){
					$ans++;
					if($ans > 1)
						break;
				}
			}
			if($ans == 1)return true;
		}
		
		return false;
    }
}

/**
 * Your MagicDictionary object will be instantiated and called as such:
 * $obj = MagicDictionary();
 * $obj->buildDict($dictionary);
 * $ret_2 = $obj->search($searchWord);
 */

(new Solution())->test();