<?php

require_once 'base\AlgorithmBase.php';
//二维数组中的查找-左上角/右下角开始遍历
class Solution extends \algorithm\base\AlgorithmBase
{
 function findNumberIn2DArray($matrix, $target) {
        $r = count($matrix);
        $c = count($matrix[0]);
        $i = 0;
        $j = $c - 1 > 0 ? $c - 1 : 0;
        while($j >= 0 && $i < $r){
            if($matrix[$i][$j] == $target)
                return true;
            if($matrix[$i][$j] < $target){
                $i++;
            }else{
                $j--;
            }
        }

        return false;
    }
	
	

	function test(){
		echo($this->findNumberIn2DArray([[1,2,3,4,5],[6,7,8,9,10],[11,12,13,14,15],[16,17,18,19,20],[21,22,23,24,25]],15)?'1':'0').PHP_EOL;
	}
}

(new Solution())->test();