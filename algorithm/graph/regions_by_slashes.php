<?php

require '..\base\AlgorithmBase.php';

//由斜杠划分区域-并查集/找孤岛
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 并查集
	//每一个格子划分为 上0右1下2左3 4个区域 
	private $f;
    function find($x){
        return $x == $this->f[$x] ? $x : $this->find($this->f[$x]);
    }
    function merge($u,$v){
        $fu = $this->find($u);
        $fv = $this->find($v);
        if($fu != $fv){
            $this->f[$fv] = $fu;
        }
    }
     function regionsBySlashes($grid) {
         $this->f = [];
        $n = count($grid);
        for($i = 0;$i < 4 * $n*$n;$i++){
            $this->f[$i] = $i;
        }

        for($i = 0;$i < $n;$i++){
            for($j = 0;$j < $n;$j++){
                $s = 4*($i*$n+$j);
                if($grid[$i][$j] == '/'){
                    $this->merge($s,$s+3);
                    $this->merge($s+1,$s+2);
                }else{
                    $this->merge($s,$s+1);
                    $this->merge($s+2,$s+3);
                }
                if($grid[$i][$j] == ' '){
                    $this->merge($s,$s+2);
                }
                if($i > 0)
                    $this->merge($s,$s-4*$n+2);
                if($i < $n - 1){
                    $this->merge($s+2,$s+4*$n);
                }            
                if($j > 0)
                    $this->merge($s+3,$s-3);
                if($j < $n-1)
                    $this->merge($s+1,$s+7);
            }
        }
        $ans = 0;
       // for($i = 0;$i < )
        foreach($this->f as $index => $num){
            if($index == $num)
                $ans++;
        }

        return $ans;
     }
	 #endregion
	
	#region 找孤岛
	//每一个格子扩充为3X3矩阵 有斜杠的为0 1为孤岛 查找为0的海洋数目
    private $dir = [
        [1,0],
        [-1,0],
        [0,1],
        [0,-1]
    ];
    function regionsBySlashes2($grid) {
        $n = count($grid);
        $new_grid = array_fill(0,3*$n,array_fill(0,3*$n,0));
        for($i = 0;$i < $n;$i++){
            for($j = 0;$j < $n;$j++){
                if($grid[$i][$j] == '/'){
                    $new_grid[3*$i][3*$j+2] = 1;
                    $new_grid[3*$i + 1][3*$j + 1] = 1;
                    $new_grid[3*$i+2][3*$j ] = 1;
                }else if($grid[$i][$j] == '\\'){
                    $new_grid[3*$i][3*$j] = 1;
                    $new_grid[3*$i + 1][3*$j + 1] = 1;
                    $new_grid[3*$i+2][3*$j +2]=1;
                }
            }
        }
        $ans = 0;
       // print_r($new_grid);
        for($i =0;$i < 3*$n;$i++){
            for($j = 0;$j < 3*$n;$j++){
                if($new_grid[$i][$j] == 0){
                    $ans++;
                    $new_grid[$i][$j] = 1;
                    $this->dfs($new_grid,$i,$j);
                }
            }
        }
        return $ans;
    }

    function dfs(&$grid,$i,$j){
        $n = count($grid);
        foreach($this->dir as $d){
            $new_i = $i + $d[0];
            $new_j = $j + $d[1];
            if($new_i >=0 && $new_i < $n && $new_j >= 0 && $new_j < $n && $grid[$new_i][$new_j] == 0){
                $grid[$new_i][$new_j] = 1;
                $this->dfs($grid,$new_i,$new_j);
            }
        }
    }
	#endregion
	
    function test(){
		print_r($this->regionsBySlashes(
			[
			  " /",
			  "/ "
			]
		));
    }
}

(new Solution())->test();