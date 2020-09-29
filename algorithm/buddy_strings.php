<?php

require_once 'base\AlgorithmBase.php';
//亲密字符串-比较差异
class Solution extends \algorithm\base\AlgorithmBase
{
    function buddyStrings($A, $B) {
        $len_a = strlen($A);
        $len_b = strlen($B);
        if($len_a != $len_b)return false;
        $diff = [];
        $same = [];
        for($i = 0;$i<$len_a;$i++){
            if($A{$i} != $B{$i}){
                if(count($diff) == 2)
                    return false;
                $diff[] = $i;
            }else{
                $same[$A[$i]]++;
            }
        }

        if(count($diff) == 2 && $A{$diff[0]} == $B{$diff[1]} && $A[$diff[1]] == $B[$diff[0]]){
            return true;
        }else{
            if(count($diff) == 0){
				
                $same = array_filter($same,function($v){
                    return $v >= 2;
                });
				
                return !empty($same);
            }
        }
		

        return false;
    }
		

	function test(){
		echo($this->buddyStrings('aa','aa')).PHP_EOL;
	}
}

(new Solution())->test();