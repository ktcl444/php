<?php

require_once 'base\AlgorithmBase.php';
//回旋镖的数量
class Solution extends \algorithm\base\AlgorithmBase
{
    function isAlienSorted($words, $order) {
        $len = count($words);
        if($len == 1)return true;
        $orders = str_split($order);
        $map = [];
        foreach($orders as $index => $char){
            $map[$char] = $index;
        }
        $l = 0;
        $r = 1;
        while($r < $len){
            $first = $words[$l];
            $second = $words[$r];
            if($this->check($first,$second,$map)){
                $l++;
                $r++;
            }else{
                return false;
            }
        }

        return true;
    }

    function check($first,$second,$map){
        $len1 = strlen($first);
        $len2 = strlen($second);
        $l = 0;
        $r = 0;
        while($l < $len1 && $r < $len2){
            $char1 = $first{$l};
            $char2 = $second{$r};
            if($map[$char1] < $map[$char2]){
                return true;
            }
            if($map[$char1] > $map[$char2]){
                return false;
            }
            $l++;
            $r++;
        }
        return $len1 < $len2;
    }

	function test(){
		echo( $this->isAlienSorted(["kuvp","q"],
"ngxlkthsjuoqcpavbfdermiywz")? '1':'0').PHP_EOL;
	}
}

(new Solution())->test();