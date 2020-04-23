<?php

require 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
	#region 波峰波谷 
    function maxProfit2($prices)
    {
		$result = 0;
		$low = $prices[0];
		$high = $prices[0];
		$i = 0;
		$length = count($prices);
		while($i < $length - 1){
			while($i+1 < $length && $prices[$i]>=$prices[$i+1]){
				$i++;
			}
			$low = $prices[$i];
			while($i + 1 < $length && $prices[$i] <= $prices[$i+1]){
				$i++;
			}
			$high = $prices[$i];
			$result += ($high - $low);
		}
		
		return $result;
    }
	#endregion
	
	#region 连续计算
	function maxProfit($prices)
    {
		$result = 0;
		$length = count($prices);
		for($i=0;$i<$length-1;$i++){
			if($prices[$i] < $prices[$i+1]){
				$result+=($prices[$i+1]-$prices[$i]);
			}
		}
		return $result;
	}
	#endregion

	function test(){
		echo $this->maxProfit([7,1,5,3,6,4]).PHP_EOL;
		echo $this->maxProfit([1,2,3,4,5]).PHP_EOL;
		echo $this->maxProfit([7,6,4,3,1]).PHP_EOL;
	}
}

(new Solution())->test();