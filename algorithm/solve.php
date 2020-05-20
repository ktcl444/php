<?php

require_once 'base\AlgorithmBase.php';

//被环绕的区域-DFS
class Solution extends \algorithm\base\AlgorithmBase
{	 
	private $rows = 0;
	private $cols = 0;
    function solve(&$board) {
		$this->rows = count($board);
		$this->cols = count($board[0]);
		for($i = 0;$i<$this->rows;$i++){
			$this->dfs($board,$i,0);
			$this->dfs($board,$i,$this->cols - 1);
		}
		for($j = 0;$j< $this->cols;$j++){
			$this->dfs($board,0,$j);
			$this->dfs($board,$this->rows - 1,$j);
		}
		for($i = 0;$i < $this->rows;$i++){
			for($j = 0;$j < $this->cols;$j ++){
				if($board[$i][$j] =='O')
					$board[$i][$j] = 'X';
				if($board[$i][$j]=='#')
					$board[$i][$j] = 'O';
			}
		}
    }
	
	function dfs(&$board,$i,$j){
		if($i <0 || $i >= $this->rows || $j < 0 || $j>= $this->cols || $board[$i][$j]!='O')return;
		
		$board[$i][$j] = '#';
		$area = [[-1,0],[0,-1],[1,0],[0,1]];
		foreach($area as $point){
			$x = $i + $point[0];
			$y = $j + $point[1];
			$this->dfs($board,$x,$y);
		}
	}
	
	function test(){
		$board = [
			["O","X","X","O","X"],
			["X","O","O","X","O"],
			["X","O","X","O","X"],
			["O","X","O","O","O"],
			["X","X","O","X","O"]
		];
		$this->solve($board);
		print_r($board);
/* 		$board = [
			['X','X','X','X'],
			['X','O','O','X'],
			['X','X','O','X'],
			['X','O','X','X']
		];
		$this->solve($board);
		print_r($board); */
	}
}

(new Solution())->test();