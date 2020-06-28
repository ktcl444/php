<?php

require_once 'base\AlgorithmBase.php';
//矩形重叠-检查相对位置/投影
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 检查相对位置
    function isRectangleOverlap($rec1, $rec2) {
        return !($rec1[2] <= $rec2[0] ||   // left
                 $rec1[3] <= $rec2[1] ||   // bottom
                 $rec1[0] >= $rec2[2] ||   // right
                 $rec1[1] >= $rec2[3]);
    }
	#endregion
	
	#region 检查投影
    function isRectangleOverlap1($rec1, $rec2) {
            return (min($rec1[2], $rec2[2]) > max($rec1[0], $rec2[0]) &&
                min($rec1[3], $rec2[3]) > max($rec1[1], $rec2[1]));
    }
	#endregion

	function test(){
		echo($this->isRectangleOverlap([0,0,1,1],[1,0,2,1]) ? '1':'0').PHP_EOL;
	}
}

(new Solution())->test();