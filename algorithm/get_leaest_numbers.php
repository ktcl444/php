<?php

require_once 'base\AlgorithmBase.php';
//最小的k个数-计数排序+最小堆
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 计数排序
	function getLeastNumbers2($arr, $k) {
        $temp = array_fill(0,10000,0);
		foreach($arr as  $v){
			$temp[$v]++;
		}
		$res = [];
		foreach($temp as $index=>$v){
			while($v > 0 && $k > 0){
				$res[] = $index;
				$v--;
				$k--;
			}
		}
		
		return $res;
    }
	#endregion
	
	#region 最小堆
	function getLeastNumbers($arr,$k){
		$heap = new SplMinHeap();
		foreach($arr as $v){
			$heap->insert($v);
		}
		$res = [];
		while($k > 0){
			array_push($res,$heap->current());
			$heap->next();
			$k--;
		}
		
		return $res;
	}
	#endregion
	
	#region 排序
    function getLeastNumbers1($arr, $k) {
        sort($arr);
        return array_slice($arr,0,$k);
    }
	#endregion
   	
	function test(){
		print_r($this->getLeastNumbers([5,1,2,4,3,7,6],4));
	}
}

(new Solution())->test();