<?php

require_once 'base\AlgorithmBase.php';

//上升下降字符串
class Solution extends \algorithm\base\AlgorithmBase
{
	
	
	function sortString($s) {
        $char_mapping = [];
        $len = strlen($s);
        for($i = 0;$i < $len;$i++){
            $char_mapping[$s{$i}]++;
        }
        ksort($char_mapping);
        $ans = '';
        $step = 0;
        while(count($char_mapping) > 0){
            $temp = '';
            foreach($char_mapping as $char => $count ){
                $temp .= $char;
                $char_mapping[$char] = --$count;
                if($count == 0){
                    unset($char_mapping[$char]);
                }
            }
			
            $ans .= $step == 0 ? $temp : strrev($temp);
            $step = 1 - $step;
        }

        return $ans;
    }
	
	function test(){
		print_r($this->sortString('aaaabbbbcccc'));
	}
}

(new Solution())->test();