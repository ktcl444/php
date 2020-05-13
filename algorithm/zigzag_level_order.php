<?php

require_once 'base\AlgorithmBase.php';

//四数相加-两两hash
class Solution extends \algorithm\base\AlgorithmBase
{
    function fourSumCount($A, $B, $C, $D) {
        $map = [];
		foreach($A as $a){
			foreach($B as $b){
				//$map[$a + $b]++;
				$map[] = $a + $b;
			}
		}
		$map = array_count_values($map);
		$result = 0;
		foreach($C as $c){
			foreach($D as $d){
				$sum = -($c + $d);
				if(array_key_exists($sum,$map)){
					$result += $map[$sum];
				}
			}
		}
		return $result;
    }
	function test(){
		echo $this->fourSumCount(
			[1,2],
			[-2,-1],
			[-1,2],
			[0,2]
		).PHP_EOL;
	}
}

(new Solution())->test();