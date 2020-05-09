<?php

require_once 'base\AlgorithmBase.php';

//有效的数独
class Solution extends \algorithm\base\AlgorithmBase
{
    function isValidSudoku($board) {
		$rows = array_fill(0,9,[]);
		$cols = array_fill(0,9,[]);
		$squares = array_fill(0,9,[]);
		
		for($i = 0;$i < 9;$i++){
			for($j = 0;$j < 9;$j++){
				$num = $board[$i][$j];
				if($num == '.')continue;
				$index = intval($i / 3) * 3 + intval($j / 3);
				
				$rows[$i][$num]++;
				$cols[$j][$num]++;
				$squares[$index][$num]++;
					
				if($rows[$i][$num] > 1 || $cols[$j][$num] > 1 || $squares[$index][$num] > 1){
					return false;
				}
			}
		}
		
		return true;
    }

	function test(){
		echo ($this->isValidSudoku([
		  ["5","3",".",".","7",".",".",".","."],
		  ["6",".",".","1","9","5",".",".","."],
		  [".","9","8",".",".",".",".","6","."],
		  ["8",".",".",".","6",".",".",".","3"],
		  ["4",".",".","8",".","3",".",".","1"],
		  ["7",".",".",".","2",".",".",".","6"],
		  [".","6",".",".",".",".","2","8","."],
		  [".",".",".","4","1","9",".",".","5"],
		  [".",".",".",".","8",".",".","7","9"]
		]) ? 'yes':'no').PHP_EOL;
	}
}

(new Solution())->test();