<?php

require '..\base\AlgorithmBase.php';

//机器人的运动范围-BFS
class Solution extends \algorithm\base\AlgorithmBase
{
	function movingCount($m, $n, $k) {
		$visited = array_fill(0,$m,array_fill(0,$n,0));
		$visited[0][0] = 1;
        $root = [[0,0]];
        $dirs = [[1,0],[0,1]];
        $ans = 0;
        while(!empty($root)){
            $p = array_shift($root);
            $x = $p[0];
            $y = $p[1];
            if($this->checkPosition($x,$y,$k)){
                $ans++;
                foreach($dirs as $dir){
                    $nx = $x + $dir[0];
                    $ny = $y + $dir[1];
                    if($nx >= 0 && $nx < $m && $ny >= 0 && $ny < $n && $visited[$nx][$ny] == 0){
						$visited[$nx][$ny] = 1;
                        $root[] = [$nx,$ny];
                    }
                }
            }
        }

        return $ans;
    }

    function checkPosition($x,$y,$k){
        return  intval($x / 10) +  intval($y / 10) + $x % 10 + $y % 10 <= $k;
    }
	
    function test()
    {
		echo ($this->movingCount(2,3,1)).PHP_EOL;
    }
}

(new Solution())->test();