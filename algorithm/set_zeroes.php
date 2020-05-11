<?php

require_once 'base\AlgorithmBase.php';

//有序矩阵中第K小的元素-二分
class Solution extends \algorithm\base\AlgorithmBase
{
	function setZeroes(&$matrix){
		$zero_index = [];
		$rows = count($matrix);
		$cols = count($matrix[0]);
		for($i = 0;$i < $rows;$i++){
			for($j = 0;$j < $cols;$j++){
				if($matrix[$i][$j] == 0){
					$zero_index[] = [$i,$j];
				}
			}
		}
		
		foreach($zero_index as $index){
			$row = $index[0];
			$col = $index[1];
			for($i = 0;$i < $cols;$i++){
				$matrix[$row][$i] = 0;
			}
			for($j = 0;$j < $rows;$j++){
				$matrix[$j][$col] = 0;
			}
		}
	}
	
	function test(){
		$matrix = [
		  [1,1,1],
		  [1,0,1],
		  [1,1,1]
		];
		$this->setZeroes($matrix);
		print_r($matrix);
		
		$matrix =[
		  [0,1,2,0],
		  [3,4,5,2],
		  [1,3,1,5]
		] ;
		$this->setZeroes($matrix);
		print_r($matrix);
	}
}

(new Solution())->test();