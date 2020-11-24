<?php

require_once 'base\AlgorithmBase.php';
//煎饼翻转-依次将最大值移到开头和末尾
class Solution extends \algorithm\base\AlgorithmBase
{
    function pancakeSort($arr) {
        $len = count($arr);
        $ans = [];
        for($i = $len;$i >= 1;$i--){
            $index = array_search($i,$arr);
            if($index < $i - 1){
				if($index > 0){
					$ans[] = $index + 1;
					$arr = $this->reverse($arr,$index+1);
				}
                $ans[] = $i;
                $arr = $this->reverse($arr,$i,1);
            }else{
                array_pop($arr);
            }
        }

        return $ans;
    }

    function reverse($array,$index,$tail = 0){
        $left = array_slice($array,0,$index);
        $right = array_slice($array,$index);
        $arr = array_merge(array_reverse($left),$right);
        if($tail){
            array_pop($arr);
        }
        return $arr;
    }
		

	function test(){
		
		print_r($this->pancakeSort([3,2,4,1]));
	}
}

(new Solution())->test();