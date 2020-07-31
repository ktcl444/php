<?php

require '..\base\AlgorithmBase.php';
//岛屿周长
class Solution extends \algorithm\base\AlgorithmBase
{
    function islandPerimeter($grid) {
        $ans = 0;
        for ($i = 0; $i < count($grid); $i++) {
            for ($j = 0; $j < count($grid[$i]); $j++) {
                if ($grid[$i][$j] == 1) {
                    if (!isset($grid[$i][$j - 1]) || $grid[$i][$j - 1] == 0) {
                        $ans++;
                    }
                    if (!isset($grid[$i][$j + 1]) || $grid[$i][$j + 1] == 0) {
                        $ans++;
                    }
                    if (!isset($grid[$i - 1][$j]) || $grid[$i - 1][$j] == 0) {
                        $ans++;
                    }
                    if (!isset($grid[$i + 1][$j]) || $grid[$i + 1][$j] == 0) {
                        $ans++;
                    }
                }
            }
        }
        return $ans;        
    }

	function islandPerimeter1($grid) {
        $perimeter = 0;
        $position = array();
        foreach($grid as $key => &$row){

            foreach($row as $k => &$item){
                if($item){
                    //周长相加
                    $perimeter += 4;
                    //同行相比，减掉周长
                    if($row[$k-1]){
                        $perimeter -=2;
                    }
                    //同列相比，减掉周长
                    if($grid[$key-1][$k]){
                        $perimeter -= 2;
                    }
                }
            }
        }
        return $perimeter;
    }

   	private $visited;
       private $direct = [[-1,0],[1,0],[0,-1],[0,1]];
    function islandPerimeter2($grid) {
        $rows = count($grid);
        $cols = count($grid[0]);
		$this->visited = array_fill(0,$rows,array_fill(0,$cols,0));
        for($i = 0;$i < $rows;$i++){
            for($j = 0;$j < $cols;$j++){
				if($grid[$i][$j] == 1)
                return 	$this->dfs($grid,$i,$j);
            }
        }

        return 0;
    }

    function dfs($grid,$x,$y){
        if($this->visited[$x][$y] == 1)
            return 0;

		if($grid[$x][$y] == 0){
			return 1;
		}
		
		if($grid[$x][$y] > 1){
			return 0;
		}
        
        $this->visited[$x][$y] = 1;
        $grid[$x][$y] = 2;
		$result = 0;
		foreach($this->direct as $d){
            $n_x = $x + $d[0];
            $n_y = $y + $d[1];
            if($n_x < 0 || $n_x >= count($grid) || $n_y < 0 || $n_y >= count($grid[0])){
                $result += 1;
            }else{
                $result += $this->dfs($grid,$n_x,$n_y);
            }
        }

        return $result;
    }

    function test()
    {
		echo ($this->islandPerimeter([
		[1,1],[1,1]
		])).PHP_EOL;
    }
}

(new Solution())->test();