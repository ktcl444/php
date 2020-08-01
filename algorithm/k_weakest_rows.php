<?php

require_once 'base\AlgorithmBase.php';
//方阵中战斗力最弱的 K 行-键排序
class Solution extends \algorithm\base\AlgorithmBase
{
    function kWeakestRows($mat, $k) {
		$powers = [];
        foreach($mat as $index => $row){
            $sum = array_sum($row);
            $powers[$sum][] = $index;
        }
        ksort($powers);
        $ans = [];
        foreach($powers as $sum => $list){
            $ans = array_merge($ans,$list);
                if(count($ans) >= $k)
                    break;
        }
        return array_splice($ans,0,$k);
		
        $powers = [];
        foreach($mat as $index => $row){
            $powers[] = array_sum($row);
        }
        asort($powers);
		$temp = [];
		foreach($powers as $index => $count){
			$temp[$count][] = $index; 
		}
		$ans = [];
		foreach($temp as $count => $list){
			sort($list);
			$ans = array_merge($ans,$list);
			if(count($ans) >= $k)
				break;
		}
        return array_splice($ans,0,$k);
    }

	function test(){
		print_r($this->kWeakestRows ([[1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0],[1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,0,0],[1,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0],[1,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0],[1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[1,1,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0],[1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,0],[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1]],17));
	}
}

(new Solution())->test();