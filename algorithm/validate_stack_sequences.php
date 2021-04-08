<?php

require_once 'base\AlgorithmBase.php';
//栈的压入、弹出序列-新堆栈/双向指针
class Solution extends \algorithm\base\AlgorithmBase
{   
	//新堆栈
	function validateStackSequences($pushed, $popped) {
		$stack = [];
		$cur = 0;
		foreach($pushed as $num){
			$stack[] = $num;
			while(!empty($stack) && end($stack) == $popped[$cur]){
				array_pop($stack);
				$cur++;
				}
		}
		
		return empty($stack);
	}
	
	//双向指针
	function validateStackSequences1($pushed, $popped) {
        $l = $r = 0;
        while($l >= 0 && $l < count($pushed)){
            if($pushed[$l] == $popped[$r]){
                array_splice($pushed,$l,1);
                array_splice($popped,$r,1);
                if($l-1 >= 0 && $pushed[$l-1] == $popped[$r]){
                    $l--;
                }
            }else{
                $l++;
            }
        }

        return empty($pushed) && empty($popped);
    }

	function test(){
		echo ($this->validateStackSequences([1,0],[1,0]) ? 1 : 0).PHP_EOL;
	}
}

(new Solution())->test();