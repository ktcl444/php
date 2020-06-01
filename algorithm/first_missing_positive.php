<?php

require 'base\AlgorithmBase.php';
//缺失的第一个正数-数组转hash表
class Solution extends \algorithm\base\AlgorithmBase
{
	#region 数组转hash表
	/* 	把 1 这个数放到下标为 0 的位置， 2 这个数放到下标为 1 的位置，按照这种思路整理一遍数组。然后我们再遍历一次数组，第 1 个遇到的它的值不等于下标的那个数，就是我们要找的缺失的第一个正数。 */
	 function firstMissingPositive($nums) {
		 $length = count($nums);
		 for($i = 0;$i < $length;$i++){
			 while($nums[$i] > 0 && $nums[$i] <= $length && $nums[$nums[$i]-1] != $nums[$i] ){
				 //swap nums[i] - 1,i				 
				 $temp = $nums[$nums[$i] - 1];
				 $nums[$nums[$i] - 1] = $nums[$i];
				 $nums[$i] = $temp;
			 }
		 }
		 
		 for($i = 0;$i < $length;$i++){
			 if($nums[$i] != $i + 1){
				 return $i + 1;
			 }
		 }
		 
		 return $length + 1;
	 }
	#endregion
	
	#region hash表
    function firstMissingPositive1($nums) {
        $length = count($nums);
		$temp = 0;
		$stack = [];
		foreach($nums as $num){
			if($num > 0 && $num < $length + 1){
				$temp++;
				$stack[$num] = 1;
			}
		}
		for($i = 1;$i <= $temp;$i++){
			if(!array_key_exists($i,$stack)){
				return $i;
			}
		}
		
		return $temp+1;
    }
	#endregion

    function test()   {
		
		 echo($this->firstMissingPositive([10,5,6,7,8,9])).PHP_EOL;
			echo($this->firstMissingPositive([1,2,0])).PHP_EOL;
		 echo($this->firstMissingPositive([3,4,-1,1])).PHP_EOL;
			echo($this->firstMissingPositive([7,8,9,11,12])).PHP_EOL;
    }
}

(new Solution())->test();