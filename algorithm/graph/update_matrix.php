<?php

require '..\base\AlgorithmBase.php';

//矩阵-动态规划+BFS
class Solution extends \algorithm\base\AlgorithmBase
{
	#region BFS
	function updateMatrix1($matrix) {
        $rows = count($matrix);
		$cols = count($matrix[0]);
		$res = array_fill(0,$rows,array_fill(0,$cols,0));
		$temp = [];
		$visited = array_fill(0,$rows,array_fill(0,$cols,0));
		for($i =0;$i < $rows;$i++){
			for($j = 0;$j < $cols;$j++){
				if($matrix[$i][$j] == 0){
					array_push($temp,[$i,$j,0]);
					$visited[$i][$j] = 1;
				}  
			}
		}
		$dirs = [[-1,0],[0,-1],[1,0],[0,1]];
		while(!empty($temp)){
			$p = array_shift($temp);
			$x = $p[0];
			$y = $p[1];
			$level = $p[2];
			$res[$x][$y] = $level;
			foreach($dirs as $dir){
				$nx = $x + $dir[0];
				$ny = $y + $dir[1];
				if(!isset($matrix[$nx][$ny]))
					continue;
				if($matrix[$nx][$ny] == 1 && $visited[$nx][$ny] == 0){
					$temp[] = [$nx,$ny,$level + 1];
					$visited[$nx][$ny] = 1;
				}
			}
		}
		
		return $res;
	}
	#endregion 
	
	#region 动态规划
    function updateMatrix($matrix) {
        $rows = count($matrix);
		$cols = count($matrix[0]);
		$res = [];
		for($i =0;$i < $rows;$i++){
			for($j = 0;$j < $cols;$j++){
				$res[$i][$j] = $matrix[$i][$j] == 0 ? 0 : PHP_INT_MAX;
			}
		}
		
		for($i =0;$i < $rows;$i++){
			for($j = 0;$j < $cols;$j++){
				if($matrix[$i][$j] == 1){
					if($i - 1 >= 0)$res[$i][$j] = min($res[$i][$j],$res[$i - 1][$j]+1);
					if($j - 1 >= 0)$res[$i][$j] = min($res[$i][$j],$res[$i][$j-1]+1);
				}
			}
		}
		
		for($i = $rows - 1;$i >= 0;$i--){
			for($j = $cols - 1;$j >= 0;$j--){
				if($matrix[$i][$j] == 1){
					if($i + 1 < $rows)$res[$i][$j] = min($res[$i][$j],$res[$i + 1][$j] + 1);
					if($j + 1 < $cols)$res[$i][$j] = min($res[$i][$j],$res[$i][$j+1]+1);
				}
			}
		}
		
		return $res;
    }
	#endregion
	
    function test()
    {
		print_r ($this->updateMatrix([
			[0,0,0],
			[0,1,0],
			[1,1,1]
		]));
    }
}

(new Solution())->test();