<?php

require_once 'base\AlgorithmBase.php';

//字符串相乘-模拟竖式
class Solution extends \algorithm\base\AlgorithmBase
{    
    function multiply($num1, $num2) {
		if($num1 == 0 || $num2 == 0)return '0';
		$l = strlen($num1)-1;
		$res = array_fill(0,strlen($num1) + strlen($num2),0);
		while($l >= 0){
			$r = strlen($num2)-1;
			while($r >= 0){
				$res[$l+$r+1] += (int)$num1{$l} *(int)$num2{$r};
				$r--;
			}
			$l--;
		}
		$temp = 0;
		for($i = count($res)-1;$i>=0;$i--){
			$res[$i]+= $temp;
			$temp = floor($res[$i] / 10);
			$res[$i] = $res[$i] % 10;
		}

		return ltrim(implode('',$res),'0');
    }
	
	function test(){
		echo($this->multiply('123','456')).PHP_EOL;
	}
	
}
(new Solution())->test();