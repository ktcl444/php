<?php

require_once 'base\AlgorithmBase.php';

//螺旋矩阵2-上下左右四指针
class Solution extends \algorithm\base\AlgorithmBase
{
	function generateMatrix($n){
		$l = 0;
		$r = $n - 1;
		$t = 0;
		$b = $n -1;
		$num = 1;
		$max = pow($n,2);
		
        $res = array_fill(0,$n,array_fill(0,$n,0));
		while($num <= $max){
			for($i = $l;$i <= $r;$i++)
				$res[$t][$i] = $num++;
			$t++;
			for($i = $t;$i <= $b;$i++)
				$res[$i][$r] = $num++;
			$r--;
			for($i = $r;$i >= $l;$i--)
				$res[$b][$i] = $num++;
			$b--;
			for($i = $b;$i >= $t;$i--)
				$res[$i][$l] = $num++;
			$l++;
		}
		
		return $res;
	}
	
	function test(){
			$this->printMatrix($this->generateMatrix(3));
			$this->printMatrix($this->generateMatrix(4));
	}
	
	function printMatrix($matrix){
		$rows = count($matrix);
		$cols = count($matrix[0]);
		$max = pow($rows,2);
		$max_length = 1;
		while($max / 10 > 0){
			$max_length++;
			$max = intval($max/10);
		}
		for($i = 0;$i < $rows;$i++){
			for($j = 0;$j < $cols;$j++){
				$cur_length = strlen($matrix[$i][$j]);
				echo $matrix[$i][$j];
				while($max_length - $cur_length > 0){
					$cur_length++;
					echo ' ';
				}
			}
			echo PHP_EOL;
		}
	}
}
(new Solution())->test();