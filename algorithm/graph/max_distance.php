<?php

require '..\base\AlgorithmBase.php';

//地图分析-动态规划
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 动态规划
	function maxDistance($grid) {
		 $rows = count($grid);
		 $cols = count($grid[0]);
		 $f = array_fill(0,$rows,array_fill(0,$cols,0));
		 for($i = 0;$i < $rows;$i++){
			 for($j = 0;$j < $cols;$j++){
				 $f[$i][$j] = ($grid[$i][$j] ? 0 : PHP_INT_MAX);
			 }
		 }
		 for($i = 0;$i < $rows;$i++){
			 for($j = 0;$j < $cols;$j++){
				 if($grid[$i][$j])continue;
				 if($i - 1 >= 0)$f[$i][$j] = min($f[$i][$j],$f[$i-1][$j] + 1);
				 if($j - 1 >= 0)$f[$i][$j] = min($f[$i][$j],$f[$i][$j-1] + 1);
			 }
		 }
		for ($i = $rows - 1; $i >= 0; --$i) {
            for ($j = $cols - 1; $j >= 0; --$j) {
                if ($grid[$i][$j]) continue;
                if ($i + 1 < $rows) $f[$i][$j] = min($f[$i][$j], $f[$i + 1][$j] + 1);
                if ($j + 1 < $cols) $f[$i][$j] = min($f[$i][$j], $f[$i][$j + 1] + 1);
            }
        }
		$res = -1;
		 for($i = 0;$i < $rows;$i++){
			 for($j = 0;$j < $cols;$j++){
				 if(!$grid[$i][$j]){
					$res = max($res,$f[$i][$j]); 
				 }
			 }
		 }
		 
		 return $res == PHP_INT_MAX ? -1 : $res;
	}
	#endregion
	 
	#region 反向BFS(未通过)
	function maxDistance1($grid) {
			 $rows = count($grid);
		 $cols = count($grid[0]);
		 $d = [];
		 $q = [];	//陆地集合 
		 for($i = 0;$i < $rows;$i++){
			 for($j = 0;$j < $cols;$j++){
				 $d[$i][$j] = PHP_INT_MAX;
				 if($grid[$i][$j] == 1){
					$d[$i][$j] = 0;
					$q[] = [$i,$j];
				 }
			 }
		 }
		 
		$direct = [[-1,0],[0,1],[1,0],[0,-1]];
		while(!empty($q)){
			 $cur  = array_shift($q);
			foreach($direct as  $di){
				$nx = $cur[0] + $di[0];
				$ny = $cur[1] + $di[1];
				if(!isset($grid[$nx][$ny])){
					continue;
				}
				if($d[$nx][$ny] > $d[$cur[0]][$cur[1]]){
					$d[$nx][$ny] = $d[$cur[0]][$cur[1]] +1;
					$q[] = [$nx,$ny];
				}
			}
		 }
		 $res = -1;
		 for($i = 0;$i < $rows;$i++){
			 for($j = 0;$j < $cols;$j++){
				 if($grid[$i][$j] == 0){
					 $res = max($res,$d[$i][$j]);
				 }
			 }
		 }
		 
		 return $res == PHP_INT_MAX ? - 1 : $res;
    }
	#endregion
	 
	#region 暴力(未通过)
    function maxDistance2($grid) {
        $rows = count($grid);
        $cols = count($grid[0]);
		
		$island = 0;
		$ocean = 0;
		foreach($grid as $x=> $row){
			foreach($row as $y => $col){
				$grid[$x][$y] == 1 && $island ++;
				$grid[$x][$y] == 0 && $ocean ++;
			}
		}
		
		$max = -1;
		if($ocean == 0 || $island == 0)
			return $max;

        foreach($grid as $x=> $row){
            foreach($row as $y => $col){
                if($grid[$x][$y] == 0){
                    $max = max($max,$this->getNearestLand($grid,$x,$y));
                }
            }
        }
        return $max;
    }


	function getNearestLand($grid,$x,$y){
		$visited = array_fill(0,$rows,array_fill(0,$cols,0));
		$queue = [[$x,$y,1]];
		$visited[$x][$y] = 1;
		$direct = [[-1,0],[0,1],[1,0],[0,-1]];
		while(!empty($queue)){
			$cur = array_shift($queue);
			foreach($direct as  $d){
				$nx = $cur[0] + $d[0];
				$ny = $cur[1] + $d[1];
				if($nx < 0 || $ny < 0 || $nx >= count($grid) || $ny >= count($grid[0]))
					continue;
				if($visited[$nx][$ny] == 0){
					array_push($queue,[$nx,$ny,$cur[2]+1]);
					$visited[$nx][$ny] = 1;
					if($grid[$nx][$ny] == 1){
						return $cur[2];
					}
				}
			}
		}
		
		return -1;
	}
	#endregion
	
    function test()
    {
		echo ($this->maxDistance([[1,0,0],[0,0,0],[0,0,0]])).PHP_EOL;
		//echo ($this->maxDistance([[1,0,1],[0,0,0],[1,0,1]])).PHP_EOL;
/* 		echo ($this->maxDistance([
			[1,0,1,0],
			[0,1,0,0],
			[0,0,1,0],
			[0,0,0,1],
			[0,1,0,0],
			[0,0,0,0],
			[1,1,0,1]])).PHP_EOL; */
 /* 		echo ($this->maxDistance([
			[1,0,0,0,0,1,0,0,0,1],
			[1,1,0,1,1,1,0,1,1,0],
			[0,1,1,0,1,0,0,1,0,0],
			[1,0,1,0,1,0,0,0,0,0],
			[0,1,0,0,0,1,1,0,1,1],
			[0,0,1,0,0,1,0,1,0,1],
			[0,0,0,1,1,1,1,0,0,1],
			[0,1,0,0,1,0,0,1,0,0],
			[0,0,0,0,0,1,1,1,0,0],
			[1,1,0,1,1,1,1,1,0,0]])).PHP_EOL;  */
		
    }
}

(new Solution())->test();