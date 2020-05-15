<?php

require_once 'base\AlgorithmBase.php';

//加油站
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 一次遍历
    function canCompleteCircuit($gas, $cost) {
		$length = count($gas);
		$total_gas = 0;
		$cur_gas = 0;
		$station_start = 0;
		for($i = 0;$i < $length;$i++){
			$total_gas += ($gas[$i] - $cost[$i]);
			$cur_gas += ($gas[$i] - $cost[$i]);
			if($cur_gas < 0){
				$cur_gas = 0;
				$station_start = $i + 1;
			}
		}
		
		return $total_gas < 0 ? -1 : $station_start;
	}
	#endregion
	#region 暴力
    function canCompleteCircuit2($gas, $cost) {
		$length = count($gas);
		$gas = array_merge($gas , $gas);
		$cost = array_merge($cost,$cost);
		for($i = 0;$i < $length;$i++){
			$station_index = $i;
			$remain = 0;
			while($station_index - $i < $length){
				$remain = $remain + $gas[$station_index] - $cost[$station_index];
				$station_index++;
				if($remain < 0){
					break;
				}
			}
			if($station_index - $i == $length && $remain >= 0){
				return $i;
			}
		}
		return -1;
    }
	#endregion
	
	function test(){
		echo $this->canCompleteCircuit(
			[1,2,3,4,5],
			[3,4,5,1,2]
		).PHP_EOL;
	 	echo $this->canCompleteCircuit(
			[2,3,4],
			[3,4,3]
		).PHP_EOL;
	}
}

(new Solution())->test();