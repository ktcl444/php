<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
	#region 左下角入口
	function  searchMatrix($matrix,$target)
	{
		if(empty($matrix)) return false;
		$row = count($matrix) -1;
		$col_max = count($matrix[0]);
		$col = 0;
		while($row >=0 && $col < $col_max)
		{
			$num = $matrix[$row][$col];
			if($num == $target)
			{
				return true;
			}else if($num < $target)
			{
				$col ++;
			}else
			{
				$row -- ;
			}
		}
		
		return false;
	}
	#endregion
	
	#region dfs
	private $matrix = [];
	private $x_length = 0;
	private $y_length = 0;
	private $visited = [];
	//private $temp = 0;
	function dfs($x,$y,$target){
		if($x >= $this->x_length || $y >= $this->y_length || $this->visited[$y][$x] == 1)
			return false;
		//$this->temp ++;
		if($this->matrix[$y][$x] == $target)
			return true;
		if($this->matrix[$y][$x] > $target)
			return false;
		
		$this->visited[$y][$x] = 1;
		return $this->dfs($x +1 ,$y,$target) || $this->dfs($x,$y+1,$target);
	}
	function  searchMatrix2($matrix,$target)
	{
		if(empty($matrix)) return false;
		$this->matrix = $matrix;
		$this->x_length = count($matrix[0]);
		$this->y_length = count($matrix);
		//$this->temp = 0;
		$this->visited = array_fill(0,$this->y_length,array_fill(0,$this->x_length,0));
		return $this->dfs(0,0,$target);
	}
	#endregion
	
	function test(){
	echo $this->searchMatrix([					],
		1)? '1':'0'.PHP_EOL;
		echo $this->searchMatrix([
			  [1,   4,  7, 11, 15],
			  [2,   5,  8, 12, 19],
			  [3,   6,  9, 16, 22],
			  [10, 13, 14, 17, 24],
			  [18, 21, 23, 26, 30]
		],5)? '1':'0'.PHP_EOL;
		//echo $this->temp.''.PHP_EOL;
		echo $this->searchMatrix([
			  [1,   4,  7, 11, 15],
			  [2,   5,  8, 12, 19],
			  [3,   6,  9, 16, 22],
			  [10, 13, 14, 17, 24],
			  [18, 21, 23, 26, 30]
		],20)?'1':'0'.PHP_EOL;
		//echo $this->temp.''.PHP_EOL;
	}
}

(new Solution())->test();