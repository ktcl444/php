<?php

require_once 'base\AlgorithmBase.php';
//整数转换-位运算
class Solution extends \algorithm\base\AlgorithmBase
{
    function convertInteger($A, $B) {
		        $c = 0;
        $diff = $A ^ $B;
        for ($i = 0; $i < 32; $i++) {
            if ($diff & 1 == 1) {
                $c++;
            }
            $diff = $diff >> 1;
        }
        return $c;
		
    if($A < 0){
        $A = abs($A);
        $A = ~$A &0xffffffff;//64->32
        $A+=1;
    }
    if($B < 0){
        $B = abs($B);
        $B = ~$B&0xffffffff;
        $B+=1;
    }
    $x = $A^$B;
    $i=0;
    while($x!=0){
        if($x & 1 == 1){
            $i++;
        }
        $x = $x>>1;
    }
    return $i;
    }
	function test(){
		echo($this->convertInteger(826966453,
-729934991)).PHP_EOL;
	}
}

(new Solution())->test();