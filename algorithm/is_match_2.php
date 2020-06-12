<?php

require_once 'base\AlgorithmBase.php';

//通配符匹配
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 回溯
		function isMatch($s,$p){
			$l = strlen($s);
			$r = strlen($p);
			$s_begin = -1;
			$p_begin = -1;
			$i = 0;
			$j = 0;
			while($i < $l){
				if($j < $r && ($s{$i} == $p{$j} || $p{$j} == '?')){
					$i++;
					$j++;
				}elseif($j < $r && $p{$j} == '*'){
					$j++;
					$s_begin = $i;
					$p_begin = $j;
				}elseif($p_begin != -1){
					$s_begin++;
					$i = $s_begin;
					$j = $p_begin;
				}else{
					return false;
				}
			}
			while($j < $r && $p{$j} == '*')$j++;
			return $j == $r;
		}
	#endregion
	#region 递归
	private $dp = [];
	function isMatch1($s,$p){
		$this->dp = [];
		$p = $this->cutOffStar($p);
		$res = $this->helper($s,$p,0,0);
		//print_r($this->dp);
		return $res;
	}
	
	function helper($s,$p,$l,$r){
		if(isset($this->dp[$l][$r]))return $this->dp[$l][$r];
		
		$s1 = substr($s,$l);
		$p1 = substr($p,$r);
		//echo 's:'.$s1.' p:'.$p1.PHP_EOL;
		if($s1 == $p1 ||  $p1 == '*')
			$this->dp[$l][$r] = true;
		elseif($s1 == '' || $p1 == '')
			$this->dp[$l][$r] = false;
		elseif($s1{0} == $p1{0} || $p1[0] == '?'){
			$this->dp[$l][$r] = $this->helper($s,$p,$l+1,$r+1);}
		elseif($p1{0} == '*')
			$this->dp[$l][$r] = $this->helper($s,$p,$l+1,$r) || $this->helper($s,$p,$l,$r+1);
		else
			$this->dp[$l][$r] = false;
		
		return $this->dp[$l][$r];
	}
	
	function cutOffStar($p){
		if(empty($p))return $p;
		$res = [$p{0}];
		$length = strlen($p);
		for($i = 1;$i < $length;$i++){
			if($p{$i - 1} != '*' || ($p{$i - 1} == '*' && $p{$i} != '*')){
				$res[] = $p{$i};
			}
		}
		
		return implode('',$res);
	}
	#endregion
	
	function test(){
		echo ($this->isMatch('aa','a')?'1':'0').PHP_EOL;
		echo ($this->isMatch('aa','*')?'1':'0').PHP_EOL;
		echo ($this->isMatch('cb','?a')?'1':'0').PHP_EOL;
		echo ($this->isMatch('adceb','*a*b')?'1':'0').PHP_EOL;
		echo ($this->isMatch('acdcb','a*c?b')?'1':'0').PHP_EOL;
	}
}

(new Solution())->test();