<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
	#region 区间排序
	function merge1($intervals) {
		$length = count($intervals);
		if($length<=1) return $intervals;
		
		$min_list = [];
		$min_max_mapping = [];
		
		foreach($intervals as $interval)
		{
			$min = $interval[0];
			$max = $interval[1];
			$min_max_mapping[$min] = max($max,$min_max_mapping[$min]);
		}
		
		$min_list = array_keys($min_max_mapping);
		$length = count($min_list);
		if($length ==1) return [[$min_list[0],$min_max_mapping[$min_list[0]]]];

		sort($min_list);
		
		$i = 0;
		$result = [];
		while($i < $length)
		{
			$min = $min_list[$i];
			$max = $min_max_mapping[$min_list[$i]];
			while($i<$length && $max >= $min_list[++$i]){
				$max = max($max,$min_max_mapping[$min_list[$i]]);
			}
			$result[] = [$min,$max];
		}
		return $result;
	}
	#endregion
	
	#region 排序遍历
    function merge($intervals) {
		$length = count($intervals);
		if($length<=1) return $intervals;
		usort($intervals,function($a,$b){
			return $a[0] - $b[0];
		});
		$result = [];
		
		foreach($intervals as $interval)
		{
			if(empty($result) || end($result)[1] < $interval[0])
			{
				$result[] = $interval;
			}else
			{
		        $max = max(end($result)[1],$interval[1]);
				$result[count($result)-1] = [end($result)[0],$max]; 
			}
		}
		return $result;
    }
	#endregion
	
	function test(){
		print_r($this->merge([[1,3],[2,6],[8,10],[15,18]]));
	}
}

(new Solution())->test();