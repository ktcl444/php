<?php

require_once 'base\AlgorithmBase.php';
//岛屿的最大面积-DFS+BFS
class Solution extends \algorithm\base\AlgorithmBase
{
    private $grid;
    private $rows;
    private $cols;

    /**
     * @param Integer[][] $grid
     * @return Integer
     */
	 
	#region DFS
    function maxAreaOfIsland($grid) {
        $this->grid = $grid;
        $this->rows = count($grid);
        $this->cols = count($grid[0]);
        $max = 0;

        for($x = 0;$x < $this->rows;$x++){
            for($y = 0;$y < $this->cols;$y++){
                if($grid[$x][$y] == 1){
                    $area = 0;
                    $this->dfs($x,$y,$area);
                    $max = max($max,$area);
                }
            }
        }

        return $max;
    }

    function dfs($x,$y,&$area){
		if(isset($this->grid[$x][$y]) && $this->grid[$x][$y] == 1){
			$area++;
			$this->grid[$x][$y] = 0;
			$this->dfs($x-1,$y,$area);
			$this->dfs($x,$y-1,$area);
			$this->dfs($x+1,$y,$area);
			$this->dfs($x,$y+1,$area);
		}
    }
	#endregion
	
	#region BFS
	function maxAreaOfIsland1($grid) {
		$this->grid = $grid;
        $this->rows = count($grid);
        $this->cols = count($grid[0]);
        $max = 0;
		$direct = [[1,0],[0,1],[-1,0],[0,-1]];
        for($x = 0;$x < $this->rows;$x++){
            for($y = 0;$y < $this->cols;$y++){
                if($grid[$x][$y] == 1){
                    $area = 1;
					$neighbour = [[$x,$y]];
					$this->grid[$x][$y] = 0;
					
					while(!empty($neighbour)){
						$cur = array_pop($neighbour);
						$cx = $cur[0];
						$cy = $cur[1];
						 
						foreach($direct as $d){
							$nx = $cx + $d[0];
							$ny = $cy + $d[1];
							if($nx < 0 || $ny < 0 || $nx >= $this->rows || $ny >= $this->cols || $this->grid[$nx][$ny] == 0)
								continue;
							$area++;
							$this->grid[$nx][$ny] = 0;
							array_push($neighbour,[$nx,$ny]);
						}
					}
					$max = max($max,$area);
                }
            }
        }

        return $max;
	}
	#endregion
	
	function test(){
		echo($this->maxAreaOfIsland([
			[1,1,0,0,0],
			[1,1,0,0,0],
			[0,0,0,1,1],
			[0,0,0,1,1]
		])).PHP_EOL;
	}
}

(new Solution())->test();