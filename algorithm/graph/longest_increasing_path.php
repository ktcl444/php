<?php

require '..\base\AlgorithmBase.php';
//矩阵中的最长递增路径-DFS
class Solution extends \algorithm\base\AlgorithmBase
{
	
	private $path_map = [];
	private $direct = [
		[0,-1],
		[0,1],
		[-1,0],
		[1,0]
	];
	private $max_length = 0;
	private $rows ;
	private $cols;
	private $matrix;
	function longestIncreasingPath($matrix) {
		if(empty($matrix))return 0;
		$this->matrix = $matrix;
        $this->rows = count($matrix);
		$this->cols = count($matrix[0]);
		$this->path_map = array_fill(0,$this->rows,array_fill(0,$this->cols,0));
		for($i = 0;$i < $this->rows;$i++){
			for($j = 0;$j < $this->cols;$j++){
				$this->max_length = max($this->dfs($i,$j),$this->max_length);
			}
		}
		
		return $this->max_length;
    }
	
	private function dfs($i,$j){
		if($this->path_map[$i][$j] != 0)return $this->path_map[$i][$j]; 
		foreach($this->direct as $index => $path){
			$next_x = $i + $path[0];
			$next_y = $j + $path[1];
			if($next_x >=0 && $next_x<$this->rows && $next_y >=0 && $next_y < $this->cols && $this->matrix[$next_x][$next_y] > $this->matrix[$i][$j])
				$this->path_map[$i][$j] = max($this->path_map[$i][$j],$this->dfs($next_x,$next_y));
		}
		return ++$this->path_map[$i][$j];
	}

    function test()   {
		echo($this->longestIncreasingPath([
		  [9,9,4],
		  [6,6,8],
		  [2,1,1]
		])).PHP_EOL;
				echo($this->longestIncreasingPath([[3,7,0,15,11,5,10,14,13,6,7,12,11,0,8,3,1,19,1,10,18,1,17,10,16,10,13,12,4,17,13,6,0,17],[3,17,1,6,10,5,17,4,14,17,14,19,3,11,1,6,16,4,11,9,11,1,10,9,11,9,19,3,1,11,4,6,11,0],[5,7,10,6,9,6,12,4,3,2,16,14,18,6,2,17,3,3,7,8,17,11,9,10,8,16,11,0,15,18,5,12,7,15],[7,11,13,9,16,16,11,6,18,2,13,11,8,8,7,3,5,17,3,4,0,7,1,0,9,1,14,1,4,4,10,7,16,18],[6,0,19,6,11,10,4,8,17,1,10,2,15,16,13,18,16,10,4,15,7,2,2,18,8,12,17,16,4,19,1,5,15,11],[1,5,9,4,13,1,14,17,12,2,11,8,8,17,19,7,12,14,18,0,2,7,10,18,8,5,7,3,10,6,9,18,9,6],[14,18,10,15,1,10,13,1,19,9,4,0,12,10,17,13,10,0,14,4,19,7,4,19,9,10,3,0,3,18,12,0,2,5],[0,8,9,5,9,6,19,12,19,14,16,3,19,0,11,15,4,13,15,16,2,13,0,6,0,6,9,6,13,8,17,17,12,18],[19,1,14,10,7,0,12,6,6,19,17,2,5,16,2,10,3,12,6,15,13,17,10,2,12,2,6,13,10,2,16,3,2,5],[14,9,2,3,19,10,11,13,16,7,8,17,18,7,14,19,3,2,16,7,19,19,11,19,0,0,3,15,2,10,10,0,9,9],[6,7,17,13,13,9,16,17,3,16,14,0,1,5,18,2,9,18,1,9,3,16,6,9,11,13,17,14,12,11,17,13,17,1],[8,15,19,0,13,17,12,18,5,17,7,15,11,14,0,12,7,11,15,5,2,15,1,8,5,1,4,0,15,7,17,1,18,11],[7,12,2,17,17,3,12,14,12,12,9,7,9,14,17,11,0,18,1,6,15,4,7,10,12,6,2,3,8,18,5,3,5,15],[3,1,12,19,13,15,1,8,5,8,8,16,16,0,0,0,19,7,7,16,13,0,14,2,16,10,3,13,7,6,17,17,5,0],[19,5,10,1,10,11,7,10,0,18,14,18,10,2,11,14,14,10,13,17,6,6,10,12,18,7,15,12,0,12,4,11,3,14],[5,6,5,14,2,8,19,0,1,1,11,4,17,6,16,8,18,4,19,0,8,4,5,5,17,1,2,6,4,6,8,10,16,15],[4,4,19,15,7,9,8,17,13,15,15,11,1,14,0,9,5,3,9,19,12,18,18,17,5,6,8,8,2,5,2,17,7,10],[13,15,2,14,15,10,12,18,19,7,1,6,3,12,9,16,18,8,11,9,8,8,16,9,17,13,13,10,11,6,1,6,10,19],[6,19,10,0,19,5,18,15,4,18,11,17,6,10,11,7,9,5,13,2,12,18,15,6,9,3,0,3,18,6,16,11,8,3],[1,19,6,4,7,9,18,12,16,15,0,13,11,14,4,15,0,3,7,1,13,2,14,10,11,1,3,9,19,4,12,0,16,19],[10,4,3,1,3,14,19,16,16,9,11,6,15,11,5,11,1,18,12,2,19,8,14,14,11,4,4,1,10,4,0,4,2,8],[18,6,6,4,7,3,6,3,10,14,17,8,4,18,4,1,4,18,10,8,8,12,11,6,11,16,6,12,12,18,18,16,15,13],[9,4,12,4,12,6,5,16,15,19,17,4,7,19,4,17,13,8,1,9,18,3,16,10,0,4,19,17,7,4,15,2,18,16],[2,7,13,2,12,4,6,13,1,14,15,3,17,4,10,18,13,3,16,7,10,13,15,7,3,6,9,5,10,11,14,9,9,1],[10,19,7,3,12,0,6,18,18,6,10,10,3,7,8,5,18,7,18,17,5,18,12,3,10,14,0,7,6,7,9,4,17,14],[9,4,14,12,10,9,12,18,12,15,13,11,6,18,7,18,19,17,12,9,16,9,9,3,16,12,12,10,7,1,1,6,15,0],[0,11,16,15,16,1,3,9,0,5,16,8,7,4,14,14,18,12,1,8,15,17,2,2,13,5,9,4,3,3,0,15,2,15],[4,1,10,15,3,13,0,14,9,10,19,5,19,19,17,3,5,13,2,15,4,2,17,13,1,9,2,18,13,16,7,1,2,1],[15,6,15,17,13,15,9,11,3,6,5,5,2,5,14,18,17,17,0,12,11,2,6,12,15,2,2,3,17,17,3,12,14,8],[8,13,7,1,4,17,10,18,10,19,10,8,3,8,5,12,2,19,17,12,8,2,9,15,14,5,3,18,9,7,7,0,9,13]])).PHP_EOL;
		
		
    }
}

(new Solution())->test();