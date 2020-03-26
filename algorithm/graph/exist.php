<?php

require_once '..\base\AlgorithmBase.php';

class Solution extends \algorithm\base\AlgorithmBase
{
	private $flags = [];
	private $y_length = 0;
	private $x_length = 0;
	private $board = [];
	private $word = '';
	private $direction = [
		[-1,0],[0,-1],[1,0],[0,1]
	];
	function exist($board, $word) {
		$this->board = $board;
		$this->word = $word;
        $this->y_length = count($board);
		$this->x_length = count($board[0]);
		$this->flags = array_fill(0,$y_length,array_fill(0,$x_length,0));
	
		for($y = 0 ;$y<$this->y_length;$y++)
		{
			for($x = 0;$x<$this->x_length;$x++)
			{
				if($this->dfs($y,$x,0))
				{
					return true;
				}
			}
		}
		return false;
    }
	
	 private function inArea($x, $y) {
        return $x >= 0 && $x < $this->x_length && $y >= 0 && $y < $this->y_length;
    }
	
	private function dfs($y_index,$x_index,$start){
		if($start == strlen($this->word) -1)
		{
			return substr($this->word,$start,1) == $this->board[$y_index][$x_index];
		}

		if(substr($this->word,$start,1) == $this->board[$y_index][$x_index])
		{
			$this->flags[$y_index][$x_index] = 1;
			for($i=0;$i<4;$i++)
			{
				$new_y = $this->direction[$i][0]+$y_index;
				$new_x = $this->direction[$i][1] + $x_index;
				if($this->inArea($new_x,$new_y) && $this->flags[$new_y][$new_x]!=1)
				{
					if($this->dfs($new_y,$new_x,$start+1))
					{
						return true;
					}
				}
				
			}
			$this->flags[$y_index][$x_index] = 0;
		}
		
		return false;
	}

	function test(){
		echo $this->exist([
			  ['A','B','C','E'],
			  ['S','F','C','S'],
			  ['A','D','E','E']
			],'ABCCE') ? 1: 0 ; 
 		 echo $this->exist([
			  ['A','B','C','E'],
			  ['S','F','E','S'],
			  ['A','D','E','E']
			],'ABCESEEEFS') ? 1: 0 ; 
			echo $this->exist([
			["a","a","a","a"],
			["a","a","a","a"],
			["a","a","a","a"],
			["a","a","a","a"],
			["a","a","a","b"]
			],"aaaaaaaaaaaaaaaaaaaa")?1:0; 
		
	}
}

(new Solution())->test();