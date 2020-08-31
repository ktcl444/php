<?php

require_once 'base\AlgorithmBase.php';
//比较含退格的字符串-数组比较
class Solution extends \algorithm\base\AlgorithmBase
{
    function backspaceCompare($S, $T) {
		return $this->getRes($S) == $this->getRes($T);
    }
	function getRes($S){
		$len1 = strlen($S);
		$s_l = [];
		for($i = 0;$i<$len1;$i++){
			$char = $S{$i};
			if($char != '#'){
				$s_l[] = $char;
			}else{
				array_pop($s_l);
			}
		}
		
		return $s_l;
	}
	function test(){
		echo($this->backspaceCompare('ab#c','ad#c')?'1':'0').PHP_EOL;
	}
}

(new Solution())->test();