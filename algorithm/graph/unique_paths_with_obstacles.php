<?php

require '..\base\AlgorithmBase.php';

//不同路径-动态规划+DFS
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 动态规划
	//dp[i][j] = dp[i-1][j] + dp[i][j-1]
	function uniquePathsWithObstacles($obstacleGrid) {
        $rows = count($obstacleGrid);
        $cols = count($obstacleGrid[0]);
		$dp = array_fill(0,$cols,0);
		$dp[0] = $obstacleGrid[0][0] == 1 ? 0 : 1;
		
		for($i = 0;$i < $rows;$i++){
			for($j = 0;$j < $cols;$j++){
				if($obstacleGrid[$i][$j] == 1){
					$dp[$j] = 0;
					continue;
				}
				if($j - 1 >= 0 && $obstacleGrid[$i][$j-1] == 0){
					$dp[$j] += $dp[$j-1];
				}
			}
		}
		
		return $dp[$cols - 1];
	}
	#endregion
	#region DFS 
	function uniquePathsWithObstacles1($obstacleGrid) {
		if($obstacleGrid[0][0] == 1)return 0;
        $rows = count($obstacleGrid);
        $cols = count($obstacleGrid[0]);

		$path_mapping = array_fill(0,$rows,array_fill(0,$cols,0));
        $direct = [[0,1],[1,0]];
        $path = [];
		$root = [[0,0,$path]];
        while(!empty($root)){
            $cur = array_pop($root);
			$path = $cur[2];
			$path[] = [$cur[0],$cur[1]];
            if($cur[0] == $rows - 1 && $cur[1] == $cols - 1){
				$this->updatePathMapping($path,$path_mapping);
            }else{
                foreach($direct as $d){
                    $nx = $cur[0] + $d[0];
                    $ny = $cur[1] + $d[1];
                    if(isset($obstacleGrid[$nx][$ny]) && $obstacleGrid[$nx][$ny] == 0){
						if($path_mapping[$nx][$ny] > 0){
							$this->updatePathMapping($path,$path_mapping,$path_mapping[$nx][$ny]);
						}else{
							$root[] = [$nx,$ny,$path];
						}
                    }
                }
            }
        }

        return $path_mapping[0][0];
    }
	
	function updatePathMapping($path,&$path_mapping,$increase = 1){
		foreach($path as $p){
			$path_mapping[$p[0]][$p[1]]+= $increase;
		}
	}
	#endregion
	
    function test(){
    		echo ($this->uniquePathsWithObstacles([
			[1,0]
		])).PHP_EOL;
				echo ($this->uniquePathsWithObstacles([
			[0,0],
			[0,0]
		])).PHP_EOL;
		echo ($this->uniquePathsWithObstacles([
			[0,0,0],
			[0,0,0]
		])).PHP_EOL;

		echo ($this->uniquePathsWithObstacles([
			[0,0,0],
			[0,0,1],
			[0,0,0]
		])).PHP_EOL;
    }
}

(new Solution())->test();