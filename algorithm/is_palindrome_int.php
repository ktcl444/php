<?php

require_once 'base\AlgorithmBase.php';

//回文数+数值比较/字符串比较
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 数值比较
	 function isPalindrome($x) {
		 if($x < 0)return false;
		 
		 $a = 0;
		 $b = $x;
		 while($b){
			 $a = $a * 10 + $b % 10;
			 $b = intval($b / 10);
		 }
		 
		 return $a == $x;
	 }
	#endregion
	#region 字符串比较
    function isPalindrome1($x) {
		if($x < 0)return false;
        $temp = ''.$x;
        $l = 0;
        $r = strlen($temp) - 1;
        while($l < $r){
            if($temp{$r--} != $temp{$l++}){
                return false;
            }
        }

        return $l >= $r;
    }
	#endregion
	
	function test(){
		
	}
}
(new Solution())->test();