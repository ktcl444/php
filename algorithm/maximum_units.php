<?php

require_once 'base\AlgorithmBase.php';
//卡车上的最大单元数-排序
class Solution extends \algorithm\base\AlgorithmBase
{    
    function maximumUnits($boxTypes, $truckSize) {
        array_multisort(array_column($boxTypes,1), SORT_DESC, $boxTypes);
        //$list = array_flip($list);
        //krsort($boxTypes);
        $total = 0;
        $ans = 0;
        foreach($boxTypes as $list){
            $count = $list[0];
            $size = $list[1];
            if($total + $count <= $truckSize){
                $total += $count;
                $ans += $size * $count;
            }else{
                $cur = $truckSize - $total;
                $total += $cur;
                $ans += $size * $cur;
                break;      
            }
        }
        return $ans;
    }

	function test(){
		echo($this->maximumUnits([[5,10],[2,5],[4,7],[3,9]],10)).PHP_EOL;
	}
}

(new Solution())->test();