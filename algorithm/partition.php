<?php

require_once 'base\AlgorithmBase.php';

//分割回文子串-回溯
class Solution extends \algorithm\base\AlgorithmBase
{
	private $res = [];
    function partition($s) {
		$length = strlen($s);
		if($length == 0)return [];
		$path = [];
		$dp = array_fill(0,$length,array_fill(0,$length,0));
		for($r = 0;$r < $length;$r++){
			for($l = 0;$l<= $r;$l++){
				if($s[$l] == $s[$r] && ($r- $l <= 2 || $dp[$l+1][$r-1])){
					$dp[$l][$r] = 1;
				}
			}
		}
		//print_r($dp);
		$this->back($s,0,$length,$path,$dp);
		return $this->res;
    }
	
	function back($s,$start,$len,$path,$dp){
		if($start == $len){
			$this->res[] = $path;
			return;
		}
		
		for($i = $start;$i < $len;$i++){
			if(!$dp[$start][$i]){
				continue;
			}
			$path[] = substr($s,$start,$i - $start + 1);
			$this->back($s,$i+1,$len,$path,$dp);
			array_pop($path);
		}
	}

	function test(){
		print_r($this->partition('abc'));
		//print_r($this->partition('caba'));
	}
}

(new Solution())->test();