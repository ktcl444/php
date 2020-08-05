<?php

require '..\base\AlgorithmBase.php';

//二维网格迁移-取模
class Solution extends \algorithm\base\AlgorithmBase
{
	function shiftGrid($grid, $k) {
		$rows = count($grid);
        $cols = count($grid[0]);
        $new_grid = array_fill(0,$rows,array_fill(0,$cols,0));
        for($x = 0;$x < $rows;$x++){
            for($y = 0;$y < $cols;$y++){
                $new_c = ($y + $k) % $cols;
                $move_r = ($y + $k) / $cols;
                $new_r = ($x + $move_r) % $rows;
                $new_grid[$new_r][$new_c] = $grid[$x][$y];
            }
        }
        return $new_grid;
		
		//print_r($grid);
        $rows = count($grid);
        $cols = count($grid[0]);

        $move_r = $k / $cols;
        $move_r = $move_r % $rows;
        $move_c = $k % $cols;
		
		//echo 'r:'.$move_r.' c:'.$move_c.PHP_EOL;

        if($move_r == 0){
            $ans = $grid;
        }else{
            $ans = [];
            for($x =$rows - $move_r ;$x < $rows;$x++){
                $ans[] = $grid[$x];
            }
            for($x = 0;$x < $rows - $move_r;$x++){
                $ans[] = $grid[$x];
            }
        }
		
		//print_r($ans);

        for($i = 1;$i <= $move_c;$i++){
            $temp = array_fill(0,$rows,array_fill(0,$cols,0));
            for($x = 0;$x < $rows;$x++){
                for($y = 0;$y < $cols;$y++){
                    if($y == $cols - 1 && $x == $rows - 1){
                        $temp[0][0] = $ans[$x][$y];
                    }else{
                        if($y == $cols - 1){
                            $temp[$x+1][0] = $ans[$x][$y];
                        }else{
                            $temp[$x][$y+1] = $ans[$x][$y];
                        }
                    }
                }
            }
            $ans = $temp;
			//print_r($ans);
        }

        return $ans;
    }
    function test(){
		print_r($this->shiftGrid(
		
			[[1,2,3],[4,5,6],[7,8,9]],3
		));
    }
}

(new Solution())->test();