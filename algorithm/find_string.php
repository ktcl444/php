<?php

require_once 'base\AlgorithmBase.php';
//稀疏数组搜索-双指针
class Solution extends \algorithm\base\AlgorithmBase
{
    function findString($words, $s) {
        $len  = count($words);
        $l = 0;
        $r = $len - 1;
        while($l <= $r){
            while($l < $r && $words[$l] == '')$l++;
            while($l < $r && $words[$r] == '')$r--;
            if($l <= $r){
                $center = ($l + $r) >> 1;
                $temp = $center;
                while($temp < $r && $words[$temp] == '')$temp++;
                $diff = strcmp($s,$words[$temp]);
                if($diff == 0){ 
                    return $temp;
                }else{
                    if($diff > 0){
                        $l = $temp + 1;
                    }else{
                        $r = $center - 1;
                    }
                }
            }
 
        }

        return -1;
    }

	function test(){
		echo($this->findString(["at", "", "", "", "ball", "", "", "car", "", "", "dad", "", ""],'ball'));
	}
}

(new Solution())->test();