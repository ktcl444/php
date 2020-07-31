<?php

require '..\base\AlgorithmBase.php';
//距离顺序排列矩阵单元格
class Solution extends \algorithm\base\AlgorithmBase
{
    function allCellsDistOrder($R, $C, $r0, $c0) {
        $visited = array_fill(0,$R,(array_fill(0,$C,0)));
		$direct = [[0,-1],[0,1],[-1,0],[1,0]];
		$stack = [[$r0,$c0]];
        $ans = [[$r0,$c0]];
        $visited[$r0][$c0] = 1;
			
		while(!empty($stack)){
			$node = array_shift($stack);
			$x = $node[0];
			$y = $node[1];
			foreach($direct as $d){
				$new_x = $x + $d[0];
				$new_y = $y + $d[1];
				if($new_x >=0 && $new_x < $R && $new_y >= 0 && $new_y < $C && $visited[$new_x][$new_y] == 0){
					$stack[] = [$new_x,$new_y];
                    $visited[$new_x][$new_y] = 1;
                    $ans[] = [$new_x,$new_y];
				}
			}
		}

        return $ans;
    }

    function test()
    {
        print_r($this->allCellsDistOrder(2,2,0,1));
    }
}

(new Solution())->test();