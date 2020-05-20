<?php

require_once '..\base\AlgorithmBase.php';

//螺旋矩阵-模拟顺时针+按层模拟
class Solution extends \algorithm\base\AlgorithmBase
{
	function spiralOrder($matrix) {
		$r = count($matrix);
		$c = count($matrix[0]);
		$dr = [0,1,0,-1];
		$dc = [1,0,-1,0];
		$visited = array_fill(0,$rows,array_fill(0,$cols,0));
		$res = [];
		$x= 0;
		$y = 0;
		$di = 0;
		for($i = 0;$i < $r * $c;$i++){
			$res[] = $matrix[$x][$y];
			$visited[$x][$y] = 1;
			$new_x = $x +$dr[$di];
			$new_y =$y+ $dc[$di];
			if($new_x >=0&&$new_x<$r && $new_y >=0 && $new_y < $c && $visited[$new_x][$new_y] == 0){
				$x= $new_x;
				$y = $new_y;
			}else{
				$di =($di + 1)%4;
				$x += $dr[$di];
				$y += $dc[$di];
			}
		}
		
		return $res;
	}
	function spiralOrder1($matrix) {
		$r = count($matrix);
		$c = count($matrix[0]);
		$r1 = 0;
		$r2 = $r - 1;
		$c1 = 0;
		$c2 = $c-1;
		$res = [];
		while($r1 <= $r2 && $c1 <= $c2){
			
			for($c = $c1;$c<=$c2;$c++)$res[] = $matrix[$r1][$c];
			for($r = $r1+1;$r<=$r2;$r++)$res[] = $matrix[$r][$c2];
			
			if($r1 <$r2 && $c1 <$c2){
				for($c = $c2 -1;$c > $c1;$c--)$res[] = $matrix[$r2][$c];
				for($r=$r2;$r>$r1;$r--)$res[] = $matrix[$r][$c1];
			}
			
			$r1++;
			$r2--;
			$c1++;
			$c2--;
		}
		return $res;
	}
	function spiralOrder2($matrix) {
		$rows = count($matrix);
		$cols = count($matrix[0]);
		$count = $rows * $cols;
		$result = [];
		$visited = array_fill(0,$rows,array_fill(0,$cols,0));
		$square = 0;
		while(count($result) < $count){
			$x = $square;
			$y = $square;
			$rows = count($matrix)-$square;
			$cols = count($matrix[0])-$square;
			
			//1
			for($j = $y;$j < $cols;$j++){
				if($visited[$x][$j]==0){
					$result[] =$matrix[$x][$j];
					$visited[$x][$j] =1;
				}
			}
			
			//2
			for($i = $x+1;$i<$rows;$i++){
				if($visited[$i][$cols-1] == 0){
					$result[] = $matrix[$i][$cols-1];
					$visited[$i][$cols-1] = 1;
				}
			}
			
			//3
			for($j = $cols-2;$j >=0;$j--){
				if($visited[$rows-1][$j]==0){
					$result[] = $matrix[$rows-1][$j];
					$visited[$rows-1][$j] = 1;
				}
			}
			
			//4
			for($i = $rows - 2;$i>=0;$i--){
				if($visited[$i][$y] ==0){
					$result[] = $matrix[$i][$y];
					$visited[$i][$y] = 1;
				}
			}
			
			$square++;
		} 
		
		return $result;
    }
	function test(){
		print_r($this->spiralOrder([
		  [1, 2, 3, 4,5],
		  [6, 7, 8, 9,10],
		  [11,12,13,14,15],
		  [16,17,18,19,20],
		  [21,22,23,24,25]
		])); 
 		print_r($this->spiralOrder([
		 [ 1, 2, 3 ],
		 [ 4, 5, 6 ],
		 [ 7, 8, 9 ]
		]));
 		print_r($this->spiralOrder([
		  [1, 2, 3, 4],
		  [5, 6, 7, 8],
		  [9,10,11,12]
		])); 
	}
}

(new Solution())->test();