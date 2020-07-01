<?php

require_once 'base\AlgorithmBase.php';

//数组中数字出现的次数-分组异或+计数数组
class Solution extends \algorithm\base\AlgorithmBase
{
	//分组异或
    function singleNumbers($nums) {
		$temp = 0;
		foreach($nums as $num){
            $temp ^= $num;
        }
		
		$low = $temp & (-$temp);  //取最低位的1
		
		$res = [];
		foreach($nums as $num){
			$res[($num & $low) > 0 ? 0 : 1] ^= $num;
		}

        return $res;
    }
	
	//计数数组
	function singleNumbers1($nums) {
        $temp = array_fill(0,10000,0);
        foreach($nums as $num){
            $temp[$num]++;
        }
        $res = [];
        foreach($temp as $num => $count){
            if($count == 1){
                $res[] = $num;
            }
        }

        return $res;
    }
	
	function test(){
		print_r($this->singleNumbers([1,2,10,4,1,4,3,3]));
	}
}

(new Solution())->test();