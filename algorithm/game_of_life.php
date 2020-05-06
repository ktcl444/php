<?php

require_once 'base\AlgorithmBase.php';

//生命游戏-额外状态机
class Solution extends \algorithm\base\AlgorithmBase
{
    function gameOfLife(&$board) {
		if(empty($board))return;
		$neighbour = [0,-1,1];
		$rows = count($board);
		$cols = count($board[0]);
		for($i = 0;$i < $rows;$i++){
			for($j = 0;$j < $cols;$j++){
				
				$live = 0;
				for($k = 0;$k < 3;$k++){
					for($l = 0;$l < 3;$l++){
						if(!($neighbour[$k] == 0 && $neighbour[$l] == 0)){
							$row = $i + $neighbour[$k];
							$col = $j + $neighbour[$l];
							
							if($row < $rows && $row >=0 && $col < $cols && $col >= 0 && abs($board[$row][$col]) == 1)
								$live++;
						}
					}
				}
				//活->死 -1
				if($board[$i][$j] == 1 && ($live < 2 || $live > 3)){
					$board[$i][$j] = -1;
				}
				//死->活 2
				if($board[$i][$j] == 0 && $live == 3){
					$board[$i][$j] = 2;
				}
			}
		}
		for($i = 0;$i < $rows;$i++){
			for($j = 0;$j < $cols;$j++){
				if($board[$i][$j] == -1){
					$board[$i][$j] = 0;
				}
				if($board[$i][$j] == 2){
					$board[$i][$j] = 1;
				}
			}
		}
	}
	function test(){
		$board = [
		  [0,1,0],
		  [0,0,1],
		  [1,1,1],
		  [0,0,0]
		];
		$this->gameOfLife($board);
		print_r($board);
	}
}

(new Solution())->test();