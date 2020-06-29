<?php

require '..\base\AlgorithmBase.php';

//腐烂的橘子-BFS
class Solution extends \algorithm\base\AlgorithmBase
{
    function orangesRotting($grid) {
        $good_count = 0;
        $bad_list = [];
        foreach($grid as $row=> $rows){
            foreach($rows as $col => $point){
                if($point == 2){
                    $bad_list[] = [$row,$col];
                }
                if($point == 1){
                    $good_count++;
                }
            }
        }
        
        $direct = [[1,0],[0,1],[-1,0],[0,-1]];
        $minute = 0;
        while(!empty($bad_list) && $good_count > 0){
            $temp = [];
            foreach($bad_list as $bad){
                $x = $bad[0];
                $y = $bad[1];
                foreach($direct as $d){
                    $nx = $x + $d[0];
                    $ny = $y + $d[1];
                    if(isset($grid[$nx][$ny]) && $grid[$nx][$ny] == 1){
                        $grid[$nx][$ny] = 2;
                        $good_count--;
                        $temp[] = [$nx,$ny];
                    }
                }
            }
            $minute++;
            $bad_list = $temp;
        }

        return $good_count == 0 ? $minute : -1;
    }
	
    function test()
    {
		echo ($this->orangesRotting([[2,1,1],[1,1,0],[0,1,1]])).PHP_EOL;
    }
}

(new Solution())->test();