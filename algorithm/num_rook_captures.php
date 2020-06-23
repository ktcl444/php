<?php

require_once 'base\AlgorithmBase.php';

//可以被一步捕获的棋子数-字符串查找
class Solution extends \algorithm\base\AlgorithmBase
{    
    function numRookCaptures($board) {
        $R_i = 0;
        $R_j = 0;
        $rows = count($board);
        $cols = count($board[0]);
        for($i = 0;$i < $rows;$i++){
            for($j = 0;$j < $cols;$j++){
                if($board[$i][$j] == 'R'){
                    $R_i = $i;
                    $R_j = $j;
                    break 2;
                }
            }
        }
		
		$row = str_replace('.','',implode('',$board[$R_i]));
		$col = str_replace('.','',implode('',array_column($board,$R_j)));
		
		return 
			(strpos($row,'Rp')!== false) + 
			(strpos($row,'pR') !== false) +
			(strpos($col,'Rp') !== false) +
			(strpos($col,'pR') !== false);
        
/*         $area = [[1,0],[-1,0],[0,1],[0,-1]];
        $res = 0;
        foreach($area as $direct){
            $i = $direct[0];
            $j = $direct[1];
            $new_i = $R_i;
            $new_j = $R_j;
            while($new_i + $i >= 0 && $new_i + $i < $rows && $new_j + $j >= 0 && $new_j + $j < $cols){
                $new_i+= $i;
                $new_j += $j;
                $cheet = $board[$new_i][$new_j] ;
                if($cheet == 'B')
                    break;
                if($cheet == '.')
                    continue;
                if($cheet == 'p'){
                    $res++;
                    break;
                }
            }
        } */
        return $res;
    }
	
	function test(){
		echo($this->numRookCaptures(
		[
			[".",".",".",".",".",".",".","."],
			[".",".",".","p",".",".",".","."],
			[".",".",".","R",".",".",".","p"],
			[".",".",".",".",".",".",".","."],
			[".",".",".",".",".",".",".","."],
			[".",".",".","p",".",".",".","."],
			[".",".",".",".",".",".",".","."],
			[".",".",".",".",".",".",".","."]
		])).PHP_EOL;
	}
	
}
(new Solution())->test();