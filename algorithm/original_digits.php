<?php

require_once 'base\AlgorithmBase.php';
//从英文中重建数字-找字母出现规律
class Solution extends \algorithm\base\AlgorithmBase
{   	

	    function originalDigits($s) {
        //one
        //two
        //three
        //four
        //five
        //six
        //seven
        //eight
        //nine
        //zero

        $list = array_fill(0,26,0);
        for($i = 0,$len = strlen($s);$i < $len;$i++){
            $char = $s{$i};
            //echo $char .' : '.(ord($char)-97).PHP_EOL;
            $list[ord($char) - 97]++;
        }
        
        //z-0
        //w-2
        //u-4
        //x-6
        //g-8
        $ans = array_fill(0,10,0);
        $z = ord('z')-97;
        if($list[$z] > 0){
            $ans[0] = $list[$z];
        } 
        $w = ord('w')-97;
        if($list[$w] > 0){
            $ans[2] = $list[$w];
        }    
        $u = ord('u')-97;
        if($list[$u] > 0){
            $ans[4] = $list[$u];
        }
        $x = ord('x')-97;
        if($list[$x] > 0){
            $ans[6] = $list[$x];
        }
        $g = ord('g')-97;
        if($list[$g] > 0){
            $ans[8] = $list[$g];
        }
       // h-3,8
        //f-4,5
       // s-6,7
        $h = ord('h')-97;
        if($list[$h] > 0){
            $ans[3] = $list[$h]-$ans[8];
        }
        $f = ord('f')-97;
        if($list[$f] > 0){
            $ans[5] = $list[$f]-$ans[4];
        }
        $s = ord('s')-97;
        if($list[$s] > 0){
            $ans[7] = $list[$s]-$ans[6];
        }
       // i-9,5,6,8
       // n-1,7,9
        $i = ord('i')-97;
        if($list[$i] > 0){
            $ans[9] = $list[$i]-$ans[5]-$ans[6]-$ans[8];
        }
        $n = ord('n')-97;
        if($list[$n] > 0){
            $ans[1] = $list[$n]-$ans[7]-2*$ans[9];
        }
		print_r($ans);
        $res = '';
        for($i = 0;$i < 10;$i++){
            for($j = 0;$j < $ans[$i];$j++){
                $res .= $i;
            }
        }

        return $res;
        
    }

	function test(){
		echo( $this->originalDigits("zerozero")).PHP_EOL;
	}
}

(new Solution())->test();