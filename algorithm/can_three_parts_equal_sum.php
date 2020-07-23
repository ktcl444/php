<?php

require_once 'base\AlgorithmBase.php';
//将数组分成和相等的三个部分-算二部分即可
class Solution extends \algorithm\base\AlgorithmBase
{
    function canThreePartsEqualSum($A) {
        $sum = array_sum($A);
        $length = count($A);
        if($sum % 3 != 0)return false;
        $ave = $sum / 3;
        $count = 0;
        $index = 0;
        $temp = 0;
        while($index < $length && $count < 2){
            $temp += $A[$index++];
            if($temp == $ave ){
                $count++;
                $temp = 0;
            }
        }
        return $count == 2 && $index < $length ;
    }

	function test(){
		echo($this->canThreePartsEqualSum([0,2,1,-6,6,-7,9,1,2,0,1])?'1':'0').PHP_EOL;
	}
}

(new Solution())->test();