<?php

require_once 'base\AlgorithmBase.php';

//存在重复元素
class Solution extends \algorithm\base\AlgorithmBase
{
	function containsDuplicate($nums){
		//排序
		sort($nums);
		$i = 0;
		while($i<count($nums) - 1){
			if($nums[$i]==$nums[$i+1])
				return true;
			$i++;
		}
		return false;

		//哈希表
		$mapping = [];
		foreach($nums as $num){
			if(array_key_exists($num,$mapping))
				return true;
			else
				$mapping[$num]++;
		}
		
		return false;
	}
	function test(){
		echo $this->containsDuplicate([1,2,3,1])?'1':'0'.PHP_EOL;
		echo $this->containsDuplicate([1,2,3,4])?'1':'0'.PHP_EOL;
	}
}

(new Solution())->test();