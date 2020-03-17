<?php

require_once 'base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
	#region 深度优先搜索 递归(先搜索一个子节点及所有子孙节点 然后对下一个子节点重复)
	private $grid ;
	private $x_length = 0;
	private $y_length = 0;
	
	private function dfs($x,$y){
		if($x<0 ||$y < 0 || $x >=$this->x_length||$y >= $this->y_length || $this->grid[$y][$x] == 0)
			return;
		
		$this->grid[$y][$x] = 0;
		$this->dfs($x-1,$y);
		$this->dfs($x+1,$y);
		$this->dfs($x,$y-1);
		$this->dfs($x,$y+1);
	}
	
	function numIslands2($grid) {
		if(empty($grid)) return 0;
		$this->grid = $grid;
		$this->x_length = count($grid[0]);
		$this->y_length = count($grid);
		$result = 0;
		for($y = 0 ;$y<$this->y_length;$y++)
		{
			for($x = 0 ;$x < $this->x_length;$x++){
				if($this->grid[$y][$x] == 1)
				{
					$result ++;
					$this->dfs($x,$y);
				}
			}
		}
		return $result;
	}
	#endregion
	
	#region 广度优先搜索 迭代(先遍历所有子节点 然后依次访问每一个子节点的下级 重复)
	function numIslands($grid)
	{
		if(empty($grid)) return 0;
		$x_length = count($grid[0]);
		$y_length = count($grid);
		$result = 0;
		for($y = 0 ;$y<$y_length;$y++)
		{
			for($x = 0 ;$x < $x_length;$x++){
				if($grid[$y][$x]== 1){
					$result ++;
					$grid[$y][$x] = 0;
					$neighbour = [];
					array_push($neighbour,[$x,$y]);
					
					//print_r($grid);
					//print_r($neighbour);
					while(!empty($neighbour))
					{
						$cur = array_pop($neighbour);
						$x_index = $cur[0];
						$y_index = $cur[1];
						if($x_index - 1 >=0 && $grid[$y_index][$x_index -1] == 1)
						{
							$grid[$y_index][$x_index -1] = 0;
							array_push($neighbour,[$x_index-1,$y_index]);
						}
						if($x_index + 1 < $x_length && $grid[$y_index][$x_index +1] == 1)
						{
							$grid[$y_index][$x_index +1] = 0;
							array_push($neighbour,[$x_index+1,$y_index]);
						}
						if($y_index - 1 >=0 && $grid[$y_index-1][$x_index] == 1)
						{							
							$grid[$y_index-1][$x_index] = 0;
							array_push($neighbour,[$x_index,$y_index-1]);
						}
						if($y_index + 1 <$y_length && $grid[$y_index+1][$x_index] == 1)
						{						
							$grid[$y_index+1][$x_index] = 0;
							array_push($neighbour,[$x_index,$y_index+1]);
						}
					}
				}
			}
		}
		return $result;
	}
	#endregion

    function test()
    {
		print_r($this->numIslands([
		[1,1,1,1,0],
		[1,1,0,1,0],
		[1,1,0,0,0],
		[0,0,0,0,0]
		]
		));
 				print_r($this->numIslands([
		[1,1,0,0,0],
		[1,1,0,0,0],
		[0,0,1,0,0],
		[0,0,0,1,1]
		]
		)); 
	}
}

(new Solution())->test();